<template>
    <container-wrapper
        v-if="widget.type === 'basic-horizontal'"
        :key="widget.id"
        :class="[
			'common-layout grid-container',
			'container-box',
            isContainerDroppableHighlight ? 'highlight-droppable-widget' : '',
			selected ? 'selected' : '',
			customClass,
		]"
        :designer="designer"
        :widget="widget"
        :parent-widget="parentWidget"
        :parent-list="parentList"
        :index-of-parent-list="indexOfParentList"
        @click.stop="selectWidget(widget)">
        <el-container class="is-vertical tw-flex">
            <!--            <template v-for="(colWidget, colIdx) in widget.widgetList" :key="colWidget.id">-->
            <header-item-widget
                :widget="widget.widgetList[0]"
                :designer="designer"
                :parent-list="widget.widgetList"
                :index-of-parent-list="widget.widgetList[0].id"
                :parent-widget="widget"
                :col-height="widget.options.colHeight">
            </header-item-widget>
            <main-item-widget
                :widget="widget.widgetList[1]"
                :designer="designer"
                :parent-list="widget.widgetList"
                :index-of-parent-list="widget.widgetList[1].id"
                :parent-widget="widget"
                :col-height="widget.options.colHeight">
            </main-item-widget>
            <!--            </template>-->
            <!--            <header-item-widget-->
            <!--                :widget="widget"-->
            <!--                :designer="designer"-->
            <!--                :parent-list="parentList"-->
            <!--                :index-of-parent-list="indexOfParentList"-->
            <!--                :parent-widget="widget">-->
            <!--            </header-item-widget>-->
            <!--            <main-item-widget-->
            <!--                :widget="widget"-->
            <!--                :designer="designer"-->
            <!--                :parent-list="parentList"-->
            <!--                :index-of-parent-list="indexOfParentList"-->
            <!--                :parent-widget="widget"-->
            <!--                :col-height="widget.options.colHeight">-->
            <!--            </main-item-widget>-->
            <!--            <el-header>Header</el-header>-->
            <!--            <el-main>Main</el-main>-->
        </el-container>
    </container-wrapper>
</template>

<script>
import i18n from "@/utils/i18n";
import FieldComponents from "@/components/form-designer/form-widget/field-widget/index";
import refMixinDesign from "@/components/form-designer/refMixinDesign";
import SvgIcon from "@/components/svg-icon";
import ContainerWrapper from "@/components/form-designer/form-widget/container-widget/container-wrapper";
import containerMixin from "@/components/form-designer/form-widget/container-widget/containerMixin";
import HeaderItemWidget
    from "@/components/form-designer/form-widget/layout-widget/layout-iteam-widget/header-item-widget";
import MainItemWidget from "@/components/form-designer/form-widget/layout-widget/layout-iteam-widget/main-item-widget";

export default {
    name: "BasicHorizontalWidget",
    componentName: "BasicHorizontalWidget",
    components: {
        ...FieldComponents,
        ContainerWrapper,
        HeaderItemWidget,
        MainItemWidget,
        SvgIcon
    },
    mixins: [i18n, containerMixin, refMixinDesign],
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
        }
    },
    watch: {
        //
    },
    created() {
        //
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

.common-layout .el-header, .common-layout .el-footer {
    background-color: var(--el-color-primary-light-7);
    color: var(--el-text-color-primary);
    text-align: center;
}

.common-layout .el-main {
    background-color: var(--el-color-primary-light-9);
    color: var(--el-text-color-primary);
    text-align: center;
    height: 150px;
}

.common-layout .el-header, .common-layout .el-footer, .common-layout .el-main, .common-layout .el-aside {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
