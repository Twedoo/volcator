<template>
    <el-form-item :label="i18nt('designer.setting.tailwind.flex')">
        <el-select v-model="optionModel.flex">
            <el-option
                v-for="item in flexConfig"
                :key="item.value"
                :selected="None"
                :label="item.label"
                :value="item.value"></el-option>
        </el-select>
    </el-form-item>
</template>

<script>
import i18n from "@/utils/i18n";

export default {
    name: "FlexEditor",
    mixins: [i18n],
    props: {
        designer: Object,
        selectedWidget: Object,
        optionModel: Object
    },
    data() {
        
        return {
            flexConfig: [
                { label: "Flex", value: "tsz-flex" },
                { label: "Flex-1", value: "tsz-flex-1" },
                { label: "Auto", value: "tsz-flex-auto" },
                { label: "Initial", value: "tsz-flex-initial" },
                { label: "None", value: "tsz-flex-none" }
            ]
        };
    }
};
</script>

<style scoped></style>
