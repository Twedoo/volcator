<template>
    <container-wrapper
        v-if="widget.type === 'container'"
        :key="widget.id"
        :class="[
			customClass,
			container,
			flex,
			flexWrap,
			alignItem,
			justify,
			overflow,
			boxShadow,
			margin,
			padding,
			width,
			maxWidth,
			minWidth,
			height,
			minHeight,
			maxHeight,
			border,
			position,
			placementTrbl,
			float,
			objectPosition,
			colorBgOrGradient,
		]"
        :style="[{background: customBackgroundColor}]"
        :designer="designer"
        :widget="widget"
        :parent-widget="parentWidget"
        :parent-list="parentList"
        :index-of-parent-list="indexOfParentList"
        @click.stop="selectWidget(widget)">
        <draggable
            :list="widget.widgetList"
            item-key="id"
            v-bind="{ group: 'dragGroup', ghostClass: 'ghost', animation: 200 }"
            tag="transition-group"
            :component-data="{ name: 'fade' }">
            <template #item="{ element: subWidget, index: swIdx }">
                <div class="form-widget-list">
                    <template v-if="'container' === subWidget.category || 'layout' === subWidget.category">
                        <component
                            :is="subWidget.type + '-widget'"
                            :key="subWidget.id"
                            :widget="subWidget"
                            :designer="designer"
                            :parent-list="widget.widgetList"
                            :index-of-parent-list="swIdx"
                            :parent-widget="widget"></component>
                    </template>
                    <template v-else>
                        <component
                            :is="subWidget.type + '-widget'"
                            :key="subWidget.id"
                            :field="subWidget"
                            :designer="designer"
                            :parent-list="widget.widgetList"
                            :index-of-parent-list="swIdx"
                            :parent-widget="widget"
                            :design-state="true"></component>
                    </template>
                </div>
            </template>
        </draggable>
<!--        <div-->
<!--            v-if="designer.selectedId === widget.id && widget.type === 'container'"-->
<!--            class="tw-flex tw-items-center tw-justify-center grid-col-action">-->
<!--            <i-->
<!--                :title="i18nt('designer.hint.selectParentWidget')"-->
<!--                @click.stop="selectParentWidget(widget)">-->
<!--                <svg-icon icon-class="el-back" />-->
<!--            </i>-->
<!--            <i-->
<!--                v-if="!!parentList && parentList.length > 1"-->
<!--                :title="i18nt('designer.hint.moveUpWidget')"-->
<!--                @click.stop="moveUpWidget()">-->
<!--                <svg-icon icon-class="el-move-up" />-->
<!--            </i>-->
<!--            <i-->
<!--                v-if="!!parentList && parentList.length > 1"-->
<!--                :title="i18nt('designer.hint.moveDownWidget')"-->
<!--                @click.stop="moveDownWidget()">-->
<!--                <svg-icon icon-class="el-move-down" />-->
<!--            </i>-->
<!--            <i :title="i18nt('designer.hint.remove')" @click.stop="removeWidget">-->
<!--                <svg-icon icon-class="el-delete" />-->
<!--            </i>-->
<!--        </div>-->
<!--        <div-->
<!--            v-if="designer.selectedId === widget.id && widget.type === 'container'"-->
<!--            class="grid-col-handler">-->
<!--            <i>{{ i18nt("designer.widgetLabel." + widget.type) }}</i>-->
<!--        </div>-->
    </container-wrapper>
</template>

<script>
import i18n from "@/utils/i18n";
import FieldComponents from "@/components/form-designer/form-widget/field-widget/index";
import refMixinDesign from "@/components/form-designer/refMixinDesign";
import SvgIcon from "@/components/svg-icon";
import ContainerWrapper from "@/components/form-render/container-item/container-item-wrapper";
import containerMixin from "@/components/form-designer/form-widget/container-widget/containerMixin";
import commonSettingsMixin from "@/components/form-designer/form-widget/commonSettingMixin";
import colorBgContainerSettingMixin from "@/components/form-designer/form-widget/container-widget/setting-mixin/colorBgContainerSettingMixin";

export default {
    name: "VfContainerItem",
    componentName: "ContainerItem",
    components: {
        ...FieldComponents,
        ContainerWrapper,
        SvgIcon
    },
    mixins: [
        i18n,
        containerMixin,
        refMixinDesign,
        commonSettingsMixin,
        colorBgContainerSettingMixin
    ],
    inject: ["refList"],
    props: {
        widget: Object,
        parentWidget: Object,
        parentList: Array,
        indexOfParentList: Number,
        designer: Object,

        colHeight: {
            type: String,
            default: null
        }
    },
    data() {
        //
    },
    computed: {
        selected() {
            if (typeof this.designer !== "undefined") {
                return this.widget.id === this.designer.selectedId;
            }
            return this.widget.id
        },
        isContainerDroppableHighlight() {
            if (typeof this.designer !== "undefined") {
                return this.designer.getContainerDroppableHighlight();
            }
            return false;
        },

        container() {
            if (this.widget.options.containerBase) {
                return this.widget.options.containerBase;
            }

            return "tw-max-w-full";
        },
        customClass() {
            return this.widget.options.customClass || "";
        },
        colHeightStyle() {
            return this.colHeight ? { height: this.colHeight + "px" } : {};
        }
    },
    watch: {
        //
    },
    created() {
        this.initRefList();
    },
    methods: {
        //
    }
};
</script>

<style lang="scss" scoped>
@import '@/styles/form-widget/container.scss';
</style>
