<template>
    <el-form-item :label="i18nt('designer.setting.tailwind.float')">
        <el-select
            v-model="optionModel.float">
            <el-option
                v-for="item in floatConfig"
                :key="item.value"
                :label="item.label"
                :value="item.value"></el-option>
        </el-select>
    </el-form-item>
</template>

<script>
import i18n from "@/utils/i18n";
import float
    from "@/components/form-designer/setting-panel/tailwind-editor/position/json/float-classes.json";

export default {
    name: "FloatEditor",
    mixins: [i18n],
    props: {
        designer: Object,
        selectedWidget: Object,
        optionModel: Object,
        margin: Object
    },
    data() {
        return {
            floatConfig: float
        };
    }
};
</script>

<style scoped></style>
