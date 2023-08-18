<template>
    <container-wrapper
        v-if="widget.type === 'flexible'"
        :key="widget.id"
        :class="[
			'grid-container container-box tsz-flex tsz-min-w-fit',
			isContainerDroppableHighlight ? 'highlight-droppable-widget' : '',
			selected ? 'selected' : '',
			customClass,
			alignItem,
			justify,
			overflow,
			boxShadow
		]"
        :style="[colHeightStyle, {background: customBackgroundColor}]"
        :designer="designer"
        :widget="widget"
        :parent-widget="parentWidget"
        :parent-list="parentList"
        :index-of-parent-list="indexOfParentList"
        @click.stop="selectWidget(widget)">
        <template v-if="widget.widgetList.length === 0">
            <div class="tsz-w-24">

            </div>
        </template>
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
        <div
            v-if="designer.selectedId === widget.id && widget.type === 'flexible'"
            class="tw-flex tw-items-center tw-justify-center grid-col-action">
            <i
                :title="i18nt('designer.hint.selectParentWidget')"
                @click.stop="selectParentWidget(widget)">
                <svg-icon icon-class="el-back" />
            </i>
            <i
                v-if="!!parentList && parentList.length > 1"
                :title="i18nt('designer.hint.moveUpWidget')"
                @click.stop="moveUpWidget()">
                <svg-icon icon-class="el-move-up" />
            </i>
            <i
                v-if="!!parentList && parentList.length > 1"
                :title="i18nt('designer.hint.moveDownWidget')"
                @click.stop="moveDownWidget()">
                <svg-icon icon-class="el-move-down" />
            </i>
            <i :title="i18nt('designer.hint.remove')" @click.stop="removeWidget">
                <svg-icon icon-class="el-delete" />
            </i>
        </div>
        <div
            v-if="designer.selectedId === widget.id && widget.type === 'container'"
            class="grid-col-handler">
            <i>{{ i18nt("designer.widgetLabel." + widget.type) }}</i>
        </div>
    </container-wrapper>
</template>

<script>
import i18n from "@/utils/i18n";
import FieldComponents from "@/components/form-designer/form-widget/field-widget/index";
import refMixinDesign from "@/components/form-designer/refMixinDesign";
import SvgIcon from "@/components/svg-icon";
import ContainerWrapper from "@/components/form-designer/form-widget/container-widget/container-wrapper";
import containerMixin from "@/components/form-designer/form-widget/container-widget/containerMixin";
import commonSettingsMixin from "@/components/form-designer/form-widget/commonSettingMixin";
import colorBgContainerSettingMixin from "@/components/form-designer/form-widget/container-widget/setting-mixin/colorBgContainerSettingMixin";

export default {
    name: "FlexibleWidget",
    componentName: "FlexibleWidget",
    components: {
        ...FieldComponents,
        ContainerWrapper,
        SvgIcon
    },
    mixins: [i18n, containerMixin, refMixinDesign, commonSettingsMixin],
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
            return this.widget.id === this.designer.selectedId;
        },
        isContainerDroppableHighlight() {
            return this.designer.getContainerDroppableHighlight();
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
        selectWidget(widget) {
            this.designer.setSelected(widget);
        },

        checkContainerMove(evt) {
            return this.designer.checkWidgetMove(evt);
        },

        selectParentWidget() {
            if (this.parentWidget) {
                this.designer.setSelected(this.parentWidget);
            } else {
                this.designer.clearSelected();
            }
        },

        moveUpWidget() {
            this.designer.moveUpWidget(this.parentList, this.indexOfParentList);
        },

        moveDownWidget() {
            this.designer.moveDownWidget(this.parentList, this.indexOfParentList);
        },

        cloneGridCol(widget) {
            this.designer.cloneGridCol(widget, this.parentWidget);
        },

        removeWidget() {
            if (this.parentList) {
                let nextSelected = null;
                if (this.parentList.length === 1) {
                    if (this.parentWidget) {
                        nextSelected = this.parentWidget;
                    }
                } else if (this.parentList.length === 1 + this.indexOfParentList) {
                    nextSelected = this.parentList[this.indexOfParentList - 1];
                } else {
                    nextSelected = this.parentList[this.indexOfParentList + 1];
                }

                this.$nextTick(() => {
                    this.parentList.splice(this.indexOfParentList, 1);
                    //if (!!nextSelected) {
                    this.designer.setSelected(nextSelected);
                    //}

                    this.designer.emitHistoryChange();
                });
            }
        }
    }
};
</script>

<style lang="scss" scoped>
@import '@/styles/form-widget/container.scss';
</style>
