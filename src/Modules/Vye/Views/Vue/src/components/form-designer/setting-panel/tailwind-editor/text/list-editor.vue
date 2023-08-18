<template>
    <el-form-item :label="i18nt('designer.setting.tailwind.list')">
        <el-select
            v-model="optionModel.list">
            <el-option
                v-for="item in listConfig"
                :key="item.value"
                :selected="None"
                :label="item.label"
                :value="item.value"></el-option>
        </el-select>
    </el-form-item>
</template>

<script>
import i18n from "@/utils/i18n";
import list from "@/components/form-designer/setting-panel/tailwind-editor/text/json/list-classes.json";

export default {
    name: "ListEditor",
    mixins: [i18n],
    props: {
        designer: Object,
        selectedWidget: Object,
        optionModel: Object,
        margin: Object
    },
    data() {
        return {
            listConfig: list
        };
    }
};
</script>

<style scoped></style>
