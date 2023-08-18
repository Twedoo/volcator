<template>
    <el-form-item v-if="optionModel.activeGradient === false" :label="i18nt('designer.setting.tailwind.color')">
        <el-select v-model="optionModel.color"
                   filterable
                   remote
                   reserve-keyword
                   :remote-method="filterRemoteMethod"
                   :loading="loading"
                   @focus="setCollectionName('textColor')">

            <div v-infinite-scroll="loadRemote">
                <el-option
                    v-for="item in optionItems"
                    :key="item.value"
                    :class="item.value"
                    :selected="None"
                    :label="item.label"
                    :value="item.value"
                >
                    <span :class="[item.value, 'tsz-font-bold tsz-uppercase']"> Aa {{item.label}}</span>
                </el-option>
            </div>
        </el-select>
    </el-form-item>

    <el-form-item v-if="this.optionModel.activeGradient === true" :label="i18nt('designer.setting.tailwind.directionGradient')">
        <el-select v-model="optionModel.directionGradient"
                filterable
                remote
                reserve-keyword
                :remote-method="filterRemoteMethod"
                :loading="loading"
                @focus="setCollectionName('directionGradient')">
            <div v-infinite-scroll="loadRemote">
                <el-option
                    v-for="item in optionItems"
                    :key="item.value"
                    :class="item.value"
                    :selected="None"
                    :label="item.label"
                    :value="item.value">
                </el-option>
            </div>
        </el-select>
    </el-form-item>

    <el-form-item v-if="this.optionModel.activeGradient === true" :label="i18nt('designer.setting.tailwind.fromColor')">
        <el-select v-model="optionModel.fromColor"
                   filterable
                   remote
                   reserve-keyword
                   :remote-method="filterRemoteMethod"
                   :loading="loading"
                   @focus="setCollectionName('fromColor')">
            <div v-infinite-scroll="loadRemote">
                <el-option
                    v-for="item in optionItems"
                    :key="item.value"
                    :class="item.value"
                    :selected="None"
                    :label="item.label"
                    :value="item.value">
                    <span :class="[item.value, 'tsz-font-bold']">{{item.label}}</span>
                </el-option>
            </div>
        </el-select>
    </el-form-item>

    <el-form-item v-if="this.optionModel.activeGradient === true" :label="i18nt('designer.setting.tailwind.viaColor')">
        <el-select v-model="optionModel.viaColor"
                   filterable
                   remote
                   reserve-keyword
                   :remote-method="filterRemoteMethod"
                   :loading="loading"
                   @focus="setCollectionName('viaColor')">
            <div v-infinite-scroll="loadRemote">
                <el-option
                    v-for="item in optionItems"
                    :key="item.value"
                    :class="item.value"
                    :selected="None"
                    :label="item.label"
                    :value="item.value">
                    <span :class="[item.value, 'tsz-font-bold']">{{item.label}}</span>
                </el-option>
            </div>
        </el-select>
    </el-form-item>

    <el-form-item v-if="this.optionModel.activeGradient === true" :label="i18nt('designer.setting.tailwind.toColor')">
        <el-select
            v-model="optionModel.toColor"
            filterable
            remote
            reserve-keyword
            :remote-method="filterRemoteMethod"
            :loading="loading"
            @focus="setCollectionName('toColor')">
            <div v-infinite-scroll="loadRemote">
                <el-option
                    v-for="item in optionItems"
                    :key="item.value"
                    :class="item.value"
                    :selected="None"
                    :label="item.label"
                    :value="item.value">
                    <span :class="[item.value, 'tsz-font-bold']">{{item.label}}</span>
                </el-option>
            </div>
        </el-select>
    </el-form-item>

</template>

<script>
    import i18n from "@/utils/i18n";
    import propertyProviderSettingsMixin from "@/components/form-designer/setting-panel/tailwind-editor/propertyProviderSettingsMixin";

    export default {
        name: 'ColorEditor',
        mixins: [i18n, propertyProviderSettingsMixin],
        props: {
            designer: Object,
            selectedWidget: Object,
            optionModel: Object,
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

