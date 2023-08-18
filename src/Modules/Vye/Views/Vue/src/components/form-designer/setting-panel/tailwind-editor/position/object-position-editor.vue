<template>
    <el-form-item :label="i18nt('designer.setting.tailwind.objectPosition')">
        <el-select
            v-model="optionModel.objectPosition">
            <el-option
                v-for="item in objectPositionConfig"
                :key="item.value"
                :label="item.label"
                :value="item.value"></el-option>
        </el-select>
    </el-form-item>
</template>

<script>
import i18n from "@/utils/i18n";
import objectPosition
    from "@/components/form-designer/setting-panel/tailwind-editor/position/json/object-position-classes.json";

export default {
    name: "ObjectPositionEditor",
    mixins: [i18n],
    props: {
        designer: Object,
        selectedWidget: Object,
        optionModel: Object,
        margin: Object
    },
    data() {
        return {
            objectPositionConfig: objectPosition
        };
    }
};
</script>

<style scoped></style>
