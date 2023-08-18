<template>
    <div v-if="statusPreviewOrRender === false"
        class="container-wrapper" :class="[customClass]">
        <slot></slot>
        <div
            v-if="designer.selectedId === widget.id && !widget.internal"
            class="tw-flex tw-items-center tw-justify-center container-action">
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
                v-if="widget.type === 'table'"
                :title="i18nt('designer.hint.insertRow')"
                @click.stop="appendTableRow(widget)">
                <svg-icon icon-class="el-insert-row" />
            </i>
            <i
                v-if="widget.type === 'table'"
                :title="i18nt('designer.hint.insertColumn')"
                @click.stop="appendTableCol(widget)">
                <svg-icon icon-class="el-insert-column" />
            </i>
            <i
                v-if="widget.type === 'grid' || widget.type === 'table'"
                :title="i18nt('designer.hint.cloneWidget')"
                @click.stop="cloneContainer(widget)">
                <svg-icon icon-class="el-clone" />
            </i>
            <i :title="i18nt('designer.hint.remove')" @click.stop="removeWidget">
                <svg-icon icon-class="el-delete" />
            </i>
        </div>

        <div
            v-if="designer.selectedId === widget.id && !widget.internal"
            class="drag-handler tw-flex tw-items-center tw-justify-center">
            <i :title="i18nt('designer.hint.dragHandler')">
                <svg-icon icon-class="el-drag-move" />
            </i>
            <i>
                {{
                i18n2t(
                `designer.widgetLabel.${widget.type}`,
                `extension.widgetLabel.${widget.type}`
                )
                }}
            </i>
            <i v-if="widget.options.hidden === true">
                <svg-icon icon-class="el-hide" />
            </i>
        </div>
    </div>

    <!--  Preview or Render  -->
    <div v-else
         class="container-wrapper" :class="[customClass]">
        <slot></slot>
    </div>
</template>

<script>
import i18n from "@/utils/i18n";
import containerMixin from "@/components/form-designer/form-widget/container-widget/containerMixin";
import SvgIcon from "@/components/svg-icon";
import { loadFormConfigByElement } from "@/utils/util";

export default {
    name: "ContainerWrapper",
    components: {
        SvgIcon
    },
    mixins: [i18n, containerMixin],
    props: {
        widget: Object,
        parentWidget: Object,
        parentList: Array,
        indexOfParentList: Number,
        designer: Object
    },
    computed: {
        statusPreviewOrRender() {
            return loadFormConfigByElement('previewOrRender');
        },
        customClass() {
            return this.widget.options.customClass
                ? this.widget.options.customClass.join(" ")
                : "";
        }
    }
};
</script>

<style lang="scss" scoped>
.container-wrapper {
    position: relative;
    //margin-bottom: 5px;

    .container-action {
        position: absolute;
        //bottom: -30px;
        bottom: 0;
        right: -2px;
        height: 28px;
        line-height: 28px;
        background: $--color-primary;
        z-index: 999;

        i {
            font-size: 14px;
            color: #fff;
            margin: 0 5px;
            cursor: pointer;
        }
    }

    .drag-handler {
        position: absolute;
        top: -2px;
        //bottom: -24px;  /* 拖拽手柄位于组件下方，有时无法正常拖动，原因未明？？ */
        left: -2px;
        height: 22px;
        line-height: 22px;
        background: $--color-primary;
        z-index: 9;

        i {
            font-size: 14px;
            font-style: normal;
            color: #fff;
            margin: 4px;
            cursor: move;
        }
    }
}

.container-action,
.drag-handler {
    :deep(.svg-icon) {
        margin-left: 0.1em;
        margin-right: 0.1em;
    }
}
</style>
