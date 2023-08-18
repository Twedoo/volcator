<template>
    <el-form-item :label="i18nt('designer.setting.tailwind.position')">
        <el-select
            v-model="optionModel.position">
            <el-option
                v-for="item in positionConfig"
                :key="item.value"
                :label="item.label"
                :value="item.value"></el-option>
        </el-select>
    </el-form-item>
</template>

<script>
import i18n from "@/utils/i18n";
import position
    from "@/components/form-designer/setting-panel/tailwind-editor/position/json/position-classes.json";

export default {
    name: "PositionEditor",
    mixins: [i18n],
    props: {
        designer: Object,
        selectedWidget: Object,
        optionModel: Object,
        margin: Object
    },
    data() {
        return {
            positionConfig: position
        };
    }
};
</script>

<style scoped></style>
