<template>
    <el-form-item v-if="this.optionModel.activeGradient" :label="i18nt('designer.setting.tailwind.color')">
        <el-select
            v-model="optionModel.directionGradient"
            filterable>
            <el-option
                v-for="item in colorConfig"
                :key="item.value"
                :class="item.value"
                :selected="None"
                :label="item.label"
                :value="item.value"><span :class="[item.value, 'tsz-font-bold tsz-uppercase']"> Aa {{item.value}}</span></el-option>
        </el-select>
    </el-form-item>
</template>

<script>
import i18n from "@/utils/i18n";
import color from "@/components/form-designer/setting-panel/tailwind-editor/color/json/color-classes.json";
import SpaceEditor from "../text/space-editor";

export default {
    name: "GradientColorEditor",
    components: {SpaceEditor},
    mixins: [i18n],
    props: {
        designer: Object,
        selectedWidget: Object,
        optionModel: Object,
        margin: Object
    },
    data() {
        return {
            isHighlight: this.optionModel.activeGradient,
            colorConfig: color
        };
    },
    // methods: {
    //     containerDroppableHighlight() {
    //         this.designer.containerDroppableHighlight();
    //     },
    // }
};
</script>

<style scoped></style>
