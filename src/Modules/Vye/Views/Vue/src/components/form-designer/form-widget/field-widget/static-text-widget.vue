<template>
    <static-content-wrapper
        :designer="designer"
        :field="field"
        :design-state="designState"
        :parent-widget="parentWidget"
        :parent-list="parentList"
        :index-of-parent-list="indexOfParentList"
        :sub-form-row-index="subFormRowIndex"
        :sub-form-col-index="subFormColIndex"
        :sub-form-row-id="subFormRowId">
        <div v-if="statusPreviewOrRender === false" ref="fieldEditor" contenteditable="true" @input="handleInput" @keydown.enter.shift="handleShiftEnter">
            <p :class="[
            colorOrGradient,
            size,
            font,
            decoration,
            style,
            list,
            space,
            width,
            height,
            margin,
            padding
        ]">{{ field.options.textContent }}</p>
        </div>

        <div v-else-if="statusPreviewOrRender === true">
            <p :class="[
            colorOrGradient,
            size,
            font,
            decoration,
            style,
            list,
            space,
            width,
            height,
            margin,
            padding
        ]">{{ field.options.textContent }}</p>
        </div>
    </static-content-wrapper>
</template>

<script>
import StaticContentWrapper from "./static-content-wrapper";
import emitter from "@/utils/emitter";
import i18n, { translate } from "@/utils/i18n";
import fieldMixin from "@/components/form-designer/form-widget/field-widget/fieldMixin";
import colorSettingMixin from "@/components/form-designer/form-widget/colorSettingMixin";
import textSettingMixin from "@/components/form-designer/form-widget/textSettingMixin";
import dimensionBasicSettingMixin from "@/components/form-designer/form-widget/dimensionBasicSettingMixin";
import { loadFormConfigByElement } from "@/utils/util";

export default {
    name: "StaticTextWidget",
    componentName: "FieldWidget",
    components: {
        StaticContentWrapper
    },
    mixins: [emitter, textSettingMixin, colorSettingMixin, dimensionBasicSettingMixin, fieldMixin, i18n],
    inject: ["refList"],
    props: {
        field: Object,
        parentWidget: Object,
        parentList: Array,
        indexOfParentList: Number,
        designer: Object,

        designState: {
            type: Boolean,
            default: false
        },

        subFormRowIndex: {
            type: Number,
            default: -1
        },
        subFormColIndex: {
            type: Number,
            default: -1
        },
        subFormRowId: {
            type: String,
            default: ""
        }
    },
    computed: {
        statusPreviewOrRender() {
            return loadFormConfigByElement('previewOrRender');
        },
    },
    beforeCreate() {
        //
    },

    created() {
        this.registerToRefList();
        this.initEventHandler();

        this.handleOnCreated();
    },

    mounted() {
        this.handleOnMounted();
    },

    beforeUnmount() {
        this.unregisterFromRefList();
    },

    methods: {
        // handleShiftEnter(event) {
        //     if (event.shiftKey) {
        //         event.preventDefault();
        //         const selection = window.getSelection();
        //         const range = selection.getRangeAt(0);
        //         const br = document.createElement('br');
        //         range.insertNode(br);
        //         range.setStartAfter(br);
        //         range.setEndAfter(br);
        //         range.collapse(false);
        //         selection.removeAllRanges();
        //         selection.addRange(range);
        //     }
        // },
        handleShiftEnter(event) {
            if (event.shiftKey) {
                event.stopPropagation();
                event.preventDefault();

                const textarea = event.target;
                const start = textarea.selectionStart;
                const end = textarea.selectionEnd;
                const oldValue = this.optionModel.textContent;

                const newValue =
                    oldValue.substring(0, start) +
                    '\n' +
                    oldValue.substring(end, oldValue.length);

                this.optionModel.textContent = newValue;
                this.$nextTick(() => {
                    textarea.setSelectionRange(start + 1, start + 1);
                });
            }
        },
        handleInput(event) {
            console.log(event.target.textContent);
            this.field.options.textContent = event.target.textContent;
        }
    }
};
</script>

<style lang="scss" scoped>
@import '../../../../styles/global.scss';
</style>
