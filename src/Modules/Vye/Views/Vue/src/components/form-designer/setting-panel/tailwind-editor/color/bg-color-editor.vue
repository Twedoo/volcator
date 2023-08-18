<template>
    <el-form-item v-if="optionModel.activeGradientBg === false" :label="i18nt('designer.setting.tailwind.bgColor')">
        <el-select v-model="optionModel.bgColor"
                   filterable
                   remote
                   reserve-keyword
                   :remote-method="filterRemoteMethod"
                   :loading="loading"
                   @focus="setCollectionName('bgColor')">

            <div v-infinite-scroll="loadRemote">
                <el-option
                    v-for="item in optionItems"
                    :key="item.value"
                    :class="item.value"
                    :selected="None"
                    :label="item.label"
                    :value="item.value"
                >
                    <span :class="['tsz-font-bold tsz-uppercase']"> Aa {{item.label}}</span>
                </el-option>
            </div>
        </el-select>
    </el-form-item>

    <el-form-item v-if="this.optionModel.activeGradientBg === true" :label="i18nt('designer.setting.tailwind.directionGradientBg')">
        <el-select v-model="optionModel.directionGradientBg" filterable>
            <el-option
                v-for="item in directionGradientBgConfig"
                :key="item.value"
                :class="item.value"
                :selected="None"
                :label="item.label"
                :value="item.value">
            </el-option>
        </el-select>
    </el-form-item>

    <el-form-item v-if="this.optionModel.activeGradientBg === true" :label="i18nt('designer.setting.tailwind.fromColorBg')">
        <el-select v-model="optionModel.fromColorBg"
                   filterable
                   remote
                   reserve-keyword
                   :remote-method="filterRemoteMethod"
                   :loading="loading"
                   @focus="setCollectionName('fromColorBg')">
            <div v-infinite-scroll="loadRemote">
                <el-option
                    v-for="item in optionItems"
                    :key="item.value"
                    :class="item.value"
                    :selected="None"
                    :label="item.label"
                    :value="item.value">
                    <span :class="['tsz-font-bold']">{{item.label}}</span>
                </el-option>
            </div>
        </el-select>
    </el-form-item>

    <el-form-item v-if="this.optionModel.activeGradientBg === true" :label="i18nt('designer.setting.tailwind.viaColorBg')">
        <el-select v-model="optionModel.viaColorBg"
                   filterable
                   remote
                   reserve-keyword
                   :remote-method="filterRemoteMethod"
                   :loading="loading"
                   @focus="setCollectionName('viaColorBg')">
            <div v-infinite-scroll="loadRemote">
                <el-option
                    v-for="item in optionItems"
                    :key="item.value"
                    :class="item.value"
                    :selected="None"
                    :label="item.label"
                    :value="item.value">
                    <span :class="['tsz-font-bold']">{{item.label}}</span>
                </el-option>
            </div>
        </el-select>
    </el-form-item>

    <el-form-item v-if="this.optionModel.activeGradientBg === true" :label="i18nt('designer.setting.tailwind.toColorBg')">
        <el-select
            v-model="optionModel.toColorBg"
            filterable
            remote
            reserve-keyword
            :remote-method="filterRemoteMethod"
            :loading="loading"
            @focus="setCollectionName('toColorBg')">
            <div v-infinite-scroll="loadRemote">
                <el-option
                    v-for="item in optionItems"
                    :key="item.value"
                    :class="item.value"
                    :selected="None"
                    :label="item.label"
                    :value="item.value">
                    <span :class="['tsz-font-bold']">{{item.label}}</span>
                </el-option>
            </div>
        </el-select>
    </el-form-item>

</template>

<script>
    import i18n from "@/utils/i18n";
    import propertyProviderSettingsMixin from "@/components/form-designer/setting-panel/tailwind-editor/propertyProviderSettingsMixin";
    import directionGradientBg from "@/components/form-designer/setting-panel/tailwind-editor/color/json/gradient-direction-bg-classes.json";
    export default {
        name: 'BgColorEditor',
        mixins: [i18n, propertyProviderSettingsMixin],
        props: {
            designer: Object,
            selectedWidget: Object,
            optionModel: Object,
        },
        data() {
            return {
                directionGradientBgConfig: directionGradientBg
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

