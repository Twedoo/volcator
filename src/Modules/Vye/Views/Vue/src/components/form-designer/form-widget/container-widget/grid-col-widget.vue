<template>
    <div
        v-if="widget.type === 'grid-col' && statusPreviewOrRender === false"
        :key="widget.id"
        :class="[
			'container-box',
            'tsz-col-span-'+colSpan,
			isContainerDroppableHighlight ? 'highlight-droppable-widget' : '',
			selected ? 'selected' : '',
			customClass,
            flex,
            alignItem,
            justify,
            overflow,
            boxShadow,
            colorBgOrGradient
		]"
        :style="[colHeightStyle, {background: customBackgroundColor}]"
        @click.stop="selectWidget(widget)">
        <!--        //TODO: add to settings "tw-flex tw-items-center tw-justify-start" -->

        <draggable
            :list="widget.widgetList"
            item-key="id"
            v-bind="{ group: 'dragGroup', ghostClass: 'ghost', animation: 200 }"
            tag="transition-group"
            :component-data="{ name: 'fade' }"
            handle=".drag-handler"
            :move="checkContainerMove"
            @end="(evt) => onGridDragEnd(evt, widget.widgetList)"
            @add="(evt) => onGridDragAdd(evt, widget.widgetList)"
            @update="onGridDragUpdate">
            <template #item="{ element: subWidget, index: swIdx }">
                <div class="form-widget-list">
                    <template v-if="'container' === subWidget.category">
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
            v-if="designer.selectedId === widget.id && widget.type === 'grid-col'"
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
            <i
                :title="i18nt('designer.hint.cloneWidget')"
                @click.stop="cloneGridCol(widget)">
                <svg-icon icon-class="el-clone" />
            </i>
            <i :title="i18nt('designer.hint.remove')" @click.stop="removeWidget">
                <svg-icon icon-class="el-delete" />
            </i>
        </div>

        <div
            v-if="designer.selectedId === widget.id && widget.type === 'grid-col'"
            class="grid-col-handler">
            <i>{{ i18nt("designer.widgetLabel." + widget.type) }}</i>
        </div>
    </div>

    <!--  Preview or Render  -->
    <div
        v-else-if="widget.type === 'grid-col'"
        :key="widget.id"
        :class="[
			'container-box',
            'tsz-col-span-'+colSpan,
			customClass,
            flex,
            alignItem,
            justify,
            overflow,
            boxShadow,
            colorBgOrGradient
		]"
        :style="[colHeightStyle, {background: customBackgroundColor}]">
        <!--        //TODO: add to settings "tw-flex tw-items-center tw-justify-start" -->

        <draggable
            :list="widget.widgetList"
            item-key="id"
            v-bind="{ group: 'dragGroup', ghostClass: 'ghost', animation: 200 }"
            tag="transition-group"
            :component-data="{ name: 'fade' }"
            handle=".drag-handler"
            :move="checkContainerMove"
            @end="(evt) => onGridDragEnd(evt, widget.widgetList)"
            @add="(evt) => onGridDragAdd(evt, widget.widgetList)"
            @update="onGridDragUpdate">
            <template #item="{ element: subWidget, index: swIdx }">
                <div class="form-widget-list">
                    <template v-if="'container' === subWidget.category">
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
    </div>
</template>

<script>
import i18n from "@/utils/i18n";
import FieldComponents from "@/components/form-designer/form-widget/field-widget/index";
import refMixinDesign from "@/components/form-designer/refMixinDesign";
import SvgIcon from "@/components/svg-icon";
import VueResizable from "vue-resizable";
import commonSettingsMixin from "@/components/form-designer/form-widget/commonSettingMixin";
import colorBgContainerSettingMixin from "@/components/form-designer/form-widget/container-widget/setting-mixin/colorBgContainerSettingMixin";
import { loadFormConfigByElement } from "@/utils/util";
export default {
    name: "GridColWidget",
    componentName: "GridColWidget",
    components: {
        ...FieldComponents,
        SvgIcon,
        VueResizable
    },
    mixins: [
        i18n,
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
    emits: ["colResize:end"],
    data() {
        return {
            innerWidth: 0,
            innerSpan: 0,
            lastWidth: 0,
            fit: true,
            oldSpan: 0,
            handlers: ["r"],
            layoutProps: {
                span: this.widget.options.span || 12,
                // md: this.widget.options.md || 12,
                // sm: this.widget.options.sm || 12,
                // xs: this.widget.options.xs || 12,
                offset: this.widget.options.offset || 0,
                push: this.widget.options.push || 0,
                pull: this.widget.options.pull || 0
            }
        };
    },
    computed: {
        selected() {
            return this.widget.id === this.designer.selectedId;
        },
        isContainerDroppableHighlight() {
            return this.designer.getContainerDroppableHighlight();
        },
        customClass() {
            return this.widget.options.customClass || "";
        },
        colHeightStyle() {
            return this.colHeight ? { height: this.colHeight + "px" } : {};
        },
        colSpan() {
            return this.widget.options.colSpan;
        },
        statusPreviewOrRender() {
            return loadFormConfigByElement('previewOrRender');
        }
    },
    watch: {
        "designer.formConfig.layoutType": {
            handler(val) {
                if (this.widget.options.responsive) {
                    if (val === "H5") {
                        this.layoutProps.span = this.widget.options.xs || 12;
                    } else if (val === "Pad") {
                        this.layoutProps.span = this.widget.options.sm || 12;
                    } else {
                        this.layoutProps.span = this.widget.options.md || 12;
                    }
                } else {
                    this.layoutProps.span = this.widget.options.span || 12;
                }
            }
        },

        "widget.options.responsive": {
            handler(val) {
                let lyType = this.designer.formConfig.layoutType;
                if (val) {
                    if (lyType === "H5") {
                        this.layoutProps.span = this.widget.options.xs || 12;
                    } else if (lyType === "Pad") {
                        this.layoutProps.span = this.widget.options.sm || 12;
                    } else {
                        this.layoutProps.span = this.widget.options.md || 12;
                    }
                } else {
                    this.layoutProps.span = this.widget.options.span || 12;
                }
            }
        },

        "widget.options.span": {
            handler(val) {
                this.layoutProps.span = val;
            }
        },

        "widget.options.md": {
            handler(val) {
                this.layoutProps.span = val;
            }
        },

        "widget.options.sm": {
            handler(val) {
                this.layoutProps.span = val;
            }
        },

        "widget.options.xs": {
            handler(val) {
                this.layoutProps.span = val;
            }
        },

        "widget.options.offset": {
            handler(val) {
                this.layoutProps.offset = val;
            }
        },

        "widget.options.push": {
            handler(val) {
                this.layoutProps.push = val;
            }
        },

        "widget.options.pull": {
            handler(val) {
                this.layoutProps.pull = val;
            }
        }
    },
    created() {
        this.initRefList();
        this.initLayoutProps();
    },
    methods: {
        initLayoutProps() {
            if (this.widget.options.responsive) {
                let lyType = this.designer.formConfig.layoutType;
                if (lyType === "H5") {
                    this.layoutProps.span = this.widget.options.xs || 12;
                } else if (lyType === "Pad") {
                    this.layoutProps.span = this.widget.options.sm || 12;
                } else {
                    this.layoutProps.span = this.widget.options.md || 12;
                }
            } else {
                this.layoutProps.spn = this.widget.options.span;
            }
        },

        onGridDragEnd(evt, subList) {
            //
        },

        onGridDragAdd(evt, subList) {
            const newIndex = evt.newIndex;
            if (subList[newIndex]) {
                this.designer.setSelected(subList[newIndex]);
            }

            this.designer.emitHistoryChange();
        },

        onGridDragUpdate() {
            this.designer.emitHistoryChange();
        },

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
        },
        handleResizeStart(event) {
            this.fit = false;
            this.innerWidth = this.innerWidth ? this.innerWidth : event.width;
            this.innerSpan = this.innerSpan
                ? this.innerSpan
                : this.widget.options.span;
            this.lastWidth = this.lastWidth ? this.lastWidth : event.width;
            this.oldSpan = this.widget.options.span;
        },
        handleResizeEnd(event) {
            this.lastWidth = event.width;
            this.fit = true;
            const delta = this.widget.options.span - this.oldSpan;
            this.$emit("colResize:end", {
                delta,
                colIndex: this.indexOfParentList
            });
        },
        handleResizeMove(event) {
            if (event.width === this.lastWidth) {
                return;
            }
            this.widget.options.span = Math.floor(
                (event.width * this.innerSpan) / this.innerWidth
            );
        }
    }
};
</script>

<style lang="scss" scoped>
@import '@/styles/form-widget/container.scss';
</style>
