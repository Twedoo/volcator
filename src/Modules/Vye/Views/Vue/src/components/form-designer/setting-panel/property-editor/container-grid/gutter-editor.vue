<template>
    <div>
        <el-form-item label-width="0">
            <el-divider class="custom-divider">
                {{ i18nt("designer.setting.columnSetting") }}
            </el-divider>
        </el-form-item>
        <el-form-item :label="i18nt('designer.setting.gap')">
            <el-input-number
                :min="0"
                :max="12"
                v-model="optionModel.gap"
                style="width: 100%"></el-input-number>
        </el-form-item>
        <el-form-item :label="i18nt('designer.setting.colsOfGrid')"></el-form-item>
        <el-form-item label-width="0">
            <li
                v-for="(colItem, colIdx) in selectedWidget.cols"
                :key="colIdx"
                class="col-item">
				<span class="col-span-title">
					{{ i18nt("designer.setting.colSpanTitle") }}{{ colIdx + 1 }}
				</span>
                <el-input-number
                    v-model.number="colItem.options.colSpan"
                    :min="1"
                    :max="12"
                    class="cell-span-input"
                    @change="
						(newValue, oldValue) =>
							spanChanged(selectedWidget, colItem, colIdx, newValue, oldValue)
					"></el-input-number>
                <el-button
                    circle
                    plain
                    size="small"
                    type="danger"
                    icon="el-icon-minus"
                    class="col-delete-button"
                    @click="deleteCol(selectedWidget, colIdx)"></el-button>
            </li>
            <div>
                <el-button type="text" @click="addNewCol(selectedWidget)" v-model="optionModel.gridNumber">
                    {{ i18nt("designer.setting.addColumn") }}
                </el-button>
            </div>
        </el-form-item>
    </div>
</template>

<script>
import i18n from "@/utils/i18n";

export default {
    name: "GutterEditor",
    mixins: [i18n],
    props: {
        designer: Object,
        selectedWidget: Object,
        optionModel: Object
    },
    methods: {
        spanChanged(curGrid) {
            let spanSum = 0;
            curGrid.cols.forEach((colItem) => {
                spanSum += colItem.options.colSpan;
                this.optionModel.gridNumber = spanSum;
            });
            this.designer.saveCurrentHistoryStep();
        },

        deleteCol(curGrid, colIdx) {
            this.optionModel.gridNumber--;
            this.designer.deleteColOfGrid(curGrid, colIdx);
            this.designer.emitHistoryChange();
        },

        addNewCol(curGrid) {
            if (this.optionModel.gridNumber <= 11) {
                this.optionModel.gridNumber++;
                this.designer.addNewColOfGrid(curGrid);
                this.designer.emitHistoryChange();
            }
        }
    }
};
</script>

<style lang="scss" scoped>
li.col-item {
    list-style: none;

    span.col-span-title {
        display: inline-block;
        font-size: 13px;
        width: 120px;
    }

    .col-delete-button {
        margin-left: 6px;
    }
}
</style>
