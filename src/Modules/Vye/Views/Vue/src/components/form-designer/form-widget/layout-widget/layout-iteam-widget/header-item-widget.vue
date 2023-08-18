<template>
    <!--  TODO: settings  tw-bg-white tw-divide-y-2 tw-divide-solid tw-divide-blue-200 tw-shadow-sm tw-z-10  -->
    <div
        :key="widget.id"
        :class="[
            'grid-container container-box el-header-layout',
			isContainerDroppableHighlight ? 'highlight-droppable-widget' : '',
			selected ? 'selected' : '',
			customClass,
            flex,
			alignItem,
			justify,
			boxShadow
		]"
        :style="[colHeightStyle, {background: backgroundColor}]"
        @click.stop="selectWidget(widget)">
        <draggable
            :list="widget.widgetList"
            item-key="id"
            v-bind="{ group: 'dragGroup', ghostClass: 'ghost', animation: 200 }"
            tag="transition-group"
            :component-data="{ name: 'fade' }"
            handle=".drag-handler">
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
            v-if="designer.selectedId === widget.id && widget.type === 'header-item'"
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
            v-if="designer.selectedId === widget.id && widget.type === 'header-item'"
            class="grid-col-handler">
            <i>{{ i18nt("designer.widgetLabel." + widget.type) }}</i>
        </div>
    </div>
</template>

<script>
import i18n from "@/utils/i18n";
import FieldComponents from "@/components/form-designer/form-widget/field-widget/index";
import refMixinDesign from "@/components/form-designer/refMixinDesign";
import SvgIcon from "@/components/svg-icon";
import VueResizable from "vue-resizable";
import commonSettingsMixin from "@/components/form-designer/form-widget/commonSettingMixin";

export default {
    name: "HeaderItemWidget",
    componentName: "HeaderItemWidget",
    components: {
        ...FieldComponents,
        SvgIcon,
        VueResizable
    },
    mixins: [i18n, refMixinDesign, commonSettingsMixin],
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
        customClass() {
            return this.widget.options.customClass || "";
        },
        colHeightStyle() {
            return this.colHeight ? { height: this.colHeight + "px" } : {};
        }
    },
    created() {
        // this.initRefList();
        // this.initLayoutProps();
    },
    methods: {

        selectWidget(widget) {
            console.log("id: " + widget.id);
            this.designer.setSelected(widget);
        },

        selectParentWidget() {
            if (this.parentWidget) {
                this.designer.setSelected(this.parentWidget);
            } else {
                this.designer.clearSelected();
            }
        }
    }
};
</script>

<style lang="scss" scoped>
@import '@/styles/form-widget/container.scss';
</style>
