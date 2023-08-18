<template>

    <el-form-item :label="i18nt('designer.setting.tailwind.pictureBgPosition')">
        <el-select v-model="optionModel.pictureBgSize"
                   filterable>
            <el-option
                v-for="item in pictureBgSizeConfig"
                :key="item.value"
                :class="item.value"
                :selected="None"
                :label="item.label"
                :value="item.value"
            >
                <span :class="['tsz-font-bold tsz-uppercase']">{{item.label}}</span>
            </el-option>
        </el-select>
    </el-form-item>

    <el-form-item :label="i18nt('designer.setting.tailwind.pictureBgRepeat')">
        <el-select v-model="optionModel.pictureBgRepeat"
                   filterable>
            <el-option
                v-for="item in pictureBgRepeatConfig"
                :key="item.value"
                :class="item.value"
                :selected="None"
                :label="item.label"
                :value="item.value"
            >
                <span :class="['tsz-font-bold tsz-uppercase']">{{item.label}}</span>
            </el-option>
        </el-select>
    </el-form-item>

    <el-form-item :label="i18nt('designer.setting.tailwind.pictureBgAttachment')">
        <el-select v-model="optionModel.pictureBgAttachment"
                   filterable>
            <el-option
                v-for="item in pictureBgAttachmentConfig"
                :key="item.value"
                :class="item.value"
                :selected="None"
                :label="item.label"
                :value="item.value"
            >
                <span :class="['tsz-font-bold tsz-uppercase']">{{item.label}}</span>
            </el-option>
        </el-select>
    </el-form-item>

    <el-form-item :label="i18nt('designer.setting.tailwind.pictureBgOrigin')">
        <el-select v-model="optionModel.pictureBgOrigin"
                   filterable>
            <el-option
                v-for="item in pictureBgOriginConfig"
                :key="item.value"
                :class="item.value"
                :selected="None"
                :label="item.label"
                :value="item.value"
            >
                <span :class="['tsz-font-bold tsz-uppercase']">{{item.label}}</span>
            </el-option>
        </el-select>
    </el-form-item>

    <el-form-item :label="i18nt('designer.setting.tailwind.pictureBgPosition')">
        <el-select v-model="optionModel.pictureBgPosition"
                   filterable>
            <el-option
                v-for="item in pictureBgPositionConfig"
                :key="item.value"
                :class="item.value"
                :selected="None"
                :label="item.label"
                :value="item.value"
            >
                <span :class="['tsz-font-bold tsz-uppercase']">{{item.label}}</span>
            </el-option>
        </el-select>
    </el-form-item>

</template>

<script>
    import i18n from "@/utils/i18n";
    import propertyProviderSettingsMixin from "@/components/form-designer/setting-panel/tailwind-editor/propertyProviderSettingsMixin";
    import pictureBgAttachment from "@/components/form-designer/setting-panel/tailwind-editor/picture/json/picture-bg-attachment-classes.json";
    import pictureBgOrigin from "@/components/form-designer/setting-panel/tailwind-editor/picture/json/picture-bg-origin-classes.json";
    import pictureBgPosition from "@/components/form-designer/setting-panel/tailwind-editor/picture/json/picture-bg-position-classes.json";
    import pictureBgRepeat from "@/components/form-designer/setting-panel/tailwind-editor/picture/json/picture-bg-repeat-classes.json";
    import pictureBgSize from "@/components/form-designer/setting-panel/tailwind-editor/picture/json/picture-bg-size-classes.json";

    export default {
        name: 'PictureBgEditor',
        mixins: [i18n, propertyProviderSettingsMixin],
        props: {
            designer: Object,
            selectedWidget: Object,
            optionModel: Object,
        },
        data() {
            return {
                pictureBgAttachmentConfig: pictureBgAttachment,
                pictureBgOriginConfig: pictureBgOrigin,
                pictureBgPositionConfig: pictureBgPosition,
                pictureBgRepeatConfig: pictureBgRepeat,
                pictureBgSizeConfig: pictureBgSize,
            };
        },
        computed: {
            //
        },
        methods: {
            //
        },
        mounted() {
            //
        },
    };
</script>

<style scoped>
</style>

