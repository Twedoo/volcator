<template>
	<static-content-wrapper
		:designer="designer"
		:field="field"
		:design-state="designState"
		:display-style="field.options.displayStyle"
		:parent-widget="parentWidget"
		:parent-list="parentList"
		:index-of-parent-list="indexOfParentList"
		:sub-form-row-index="subFormRowIndex"
		:sub-form-col-index="subFormColIndex"
		:sub-form-row-id="subFormRowId">
		<button
			ref="fieldEditor"
			:type="field.options.type"
			:plain="field.options.plain"
			:round="field.options.round"
			:circle="field.options.circle"
			:icon="field.options.icon"
			:disabled="field.options.disabled"
            :class="[
                colorBgOrGradient,
                colorOrGradient,
                border,
                borderColor,
                borderColorFocus,
                boxShadow,
                width,
                height,
                margin,
                padding,
                outline,
                outlineFocus,
                size,
                font,
                decoration,
                style,
                list,
                space,
                'hide-spin-button'
                ]"
            :style="[{background: customBackgroundColor}]"
            @click="handleButtonWidgetClick">
			{{ field.options.label }}
		</button>
	</static-content-wrapper>
</template>

<script>
import StaticContentWrapper from './static-content-wrapper';
import emitter from '@/utils/emitter';
import i18n, { translate } from '@/utils/i18n';
import fieldMixin from '@/components/form-designer/form-widget/field-widget/fieldMixin';
import colorBgSettingMixin from "@/components/form-designer/form-widget/colorBgSettingMixin";
import colorSettingMixin from "@/components/form-designer/form-widget/colorSettingMixin";
import textSettingMixin from "@/components/form-designer/form-widget/textSettingMixin";

export default {
	name: 'ButtonWidget',
	componentName: 'FieldWidget',
	components: {
		StaticContentWrapper,
	},
	mixins: [emitter, fieldMixin, i18n, colorBgSettingMixin, colorSettingMixin, textSettingMixin],
	props: {
		field: Object,
		parentWidget: Object,
		parentList: Array,
		indexOfParentList: Number,
		designer: Object,

		designState: {
			type: Boolean,
			default: false,
		},

		subFormRowIndex: {
			type: Number,
			default: -1,
		},
		subFormColIndex: {
			type: Number,
			default: -1,
		},
		subFormRowId: {
			type: String,
			default: '',
		},
	},
	computed: {
        border() {
            return this.field.options.border;
        },

        borderColor() {
            return this.field.options.borderColor;
        },

        borderColorFocus() {
            return this.field.options.borderColorFocus;
        },

        borderRing() {
            return this.field.options.borderRing;
        },

        outline() {
            return this.field.options.outline;
        },

        outlineFocus() {
            return this.field.options.outlineFocus;
        },

        width() {
            return this.field.options.width;
        },

        height() {
            return this.field.options.height;
        },

        margin() {
            return this.field.options.margin;
        },

        padding() {
            return this.field.options.padding;
        },

        boxShadow() {
            return this.field.options.boxShadow;
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

	methods: {},
};
</script>

<style lang="scss" scoped>
@import '../../../../styles/global.scss';
</style>
