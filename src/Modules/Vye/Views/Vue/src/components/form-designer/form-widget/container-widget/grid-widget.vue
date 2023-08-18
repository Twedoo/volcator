<template>
    <container-wrapper
        :designer="designer"
        :widget="widget"
        :parent-widget="parentWidget"
        :parent-list="parentList"
        :index-of-parent-list="indexOfParentList">
        <div v-if="statusPreviewOrRender === false"
            :key="widget.id"
            :gutter="widget.options.gutter"
            :class="[
                'grid-container container-box tsz-grid tsz-grid-cols-'+gridNumber+' tsz-gap-'+gap,
                selected ? 'selected' : '',
                customClass,
                width,
                height,
                margin,
                padding,
                border,
                boxShadow,
                overflow,
                colorBgOrGradient
                ]"
            :style="[{background: customBackgroundColor}]"
            @click.stop="selectWidget(widget)">
            <template v-for="(colWidget, colIdx) in widget.cols" :key="colWidget.id">
                <grid-col-widget
                    :widget="colWidget"
                    :designer="designer"
                    :parent-list="widget.cols"
                    :index-of-parent-list="colIdx"
                    :parent-widget="widget"
                    :col-height="widget.options.colHeight"
                    @colResize:end="handleColResize"></grid-col-widget>
            </template>
        </div>

        <div v-else-if="statusPreviewOrRender === true"
            :key="widget.id"
            :gutter="widget.options.gutter"
            :class="[
                'grid-container container-box tsz-grid tsz-grid-cols-'+gridNumber+' tsz-gap-'+gap,
                selected ? 'selected' : '',
                customClass,
                width,
                height,
                margin,
                padding,
                border,
                boxShadow,
                overflow,
                colorBgOrGradient
                ]"
            :style="[{background: customBackgroundColor}]">
            <template v-for="(colWidget, colIdx) in widget.cols" :key="colWidget.id">
                <grid-col-widget
                    :widget="colWidget"
                    :designer="designer"
                    :parent-list="widget.cols"
                    :index-of-parent-list="colIdx"
                    :parent-widget="widget"
                    :col-height="widget.options.colHeight"
                    @colResize:end="handleColResize"></grid-col-widget>
            </template>
        </div>

    </container-wrapper>
</template>

<script>
import i18n from "@/utils/i18n";
import GridColWidget from "@/components/form-designer/form-widget/container-widget/grid-col-widget";
import containerMixin from "@/components/form-designer/form-widget/container-widget/containerMixin";
import ContainerWrapper from "@/components/form-designer/form-widget/container-widget/container-wrapper";
import refMixinDesign from "@/components/form-designer/refMixinDesign";
import dimensionBasicContainerSettingMixin from "@/components/form-designer/form-widget/container-widget/setting-mixin/dimensionBasicContainerSettingMixin";
import commonAdvancedContainerSettingMixin from "@/components/form-designer/form-widget/container-widget/setting-mixin/commonAdvancedContainerSettingMixin";
import colorBgContainerSettingMixin from "@/components/form-designer/form-widget/container-widget/setting-mixin/colorBgContainerSettingMixin";
import { loadFormConfigByElement } from "@/utils/util";

export default {
    name: "GridWidget",
    componentName: "ContainerWidget",
    components: {
        ContainerWrapper,
        GridColWidget
    },
    mixins: [
        i18n,
        containerMixin,
        refMixinDesign,
        dimensionBasicContainerSettingMixin,
        commonAdvancedContainerSettingMixin,
        colorBgContainerSettingMixin
    ],
    inject: ["refList"],
    props: {
        widget: Object,
        parentWidget: Object,

        parentList: Array,
        indexOfParentList: Number,
        designer: Object
    },
    computed: {
        selected() {
            if (!this.statusPreviewOrRender) {
                return this.widget.id === this.designer.selectedId;
            }
            return null;
        },
        customClass() {
            return this.widget.options.customClass || "";
        },
        gridNumber() {
            return this.widget.options.gridNumber;
        },
        gap() {
            return this.widget.options.gap;
        },
        statusPreviewOrRender() {
            return loadFormConfigByElement('previewOrRender');
        }
    },
    watch: {
        //
    },
    created() {
        this.initRefList();
    },
    mounted() {
        //
    },
    methods: {
        handleColResize(event) {
            let closestCol = this.widget.cols[event.colIndex + 1];
            if (!closestCol) {
                return;
            }
            closestCol.options.span = closestCol.options.span - event.delta;
        }
    }
};
</script>

<style lang="scss" scoped>
@import '@/styles/form-widget/container.scss';
</style>
