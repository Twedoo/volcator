<template>
    <el-form-item :label="i18nt('designer.setting.backgroundColor')">
        <div class="tw-flex tw-justify-between">
            <div class="el-dropdown-link tw-mr-6">
                <el-switch v-model="optionModel.activeCustomBackgroundColor"></el-switch>
            </div>

            <el-dropdown  v-if="optionModel.activeCustomBackgroundColor === true" trigger="click">
                <div class="el-dropdown-link">
                    <div :style="[{background: color}, 'height: 24px' ]" :class="['tw-px-1.5 tw-py-1.5 tw-rounded tw-w-28 tw-16-px']"></div>
                </div>
                <template #dropdown class="tw-w-80">
                    <ColorPicker
                        v-model="optionModel.backgroundColor"
                        theme="light"
                        :color="color"
                        :sucker-hide="false"
                        :sucker-canvas="suckerCanvas"
                        :sucker-area="suckerArea"
                        @changeColor="changeColor"
                    />
                </template>
            </el-dropdown>
        </div>
    </el-form-item>
</template>

<script>
import i18n from "@/utils/i18n";
import propertyMixin from "@/components/form-designer/setting-panel/property-editor/propertyMixin";
import { ColorPicker } from "vue-color-kit";
import "vue-color-kit/dist/vue-color-kit.css";

export default {
    name: "ColorKitEditor",
    mixins: [i18n, propertyMixin],
    props: {
        designer: Object,
        selectedWidget: Object,
        optionModel: Object
    },
    components: {
        ColorPicker
    },
    data() {
        return {
            activeName: 1,
            color: !this.optionModel.backgroundColor ? "rgba(255, 255, 255, 1)" : this.optionModel.backgroundColor,
            suckerCanvas: null,
            suckerArea: [],
            isSucking: false
        };
    },
    methods: {
        changeColor(color) {
            const { r, g, b, a } = color.rgba;
            this.color = `rgba(${r}, ${g}, ${b}, ${a})`;
            this.optionModel.backgroundColor = this.color;

        }
    }
};
</script>

<style lang="scss" scoped>
.hu-color-picker {
    padding: 10px;
    background: #232135;
    border-radius: 4px;
    box-shadow: 0 0 16px 0 rgba(0, 0, 0, .16);
    z-index: 1;
    width: 218px !important;
}
</style>
