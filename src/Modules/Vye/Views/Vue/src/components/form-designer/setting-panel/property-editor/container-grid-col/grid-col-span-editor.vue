<template>
	<div>
		<el-form-item
			v-if="!optionModel.responsive"
			:label="i18nt('designer.setting.colSpanTitle')">
			<el-input-number
				v-model.number="optionModel.span"
				:min="1"
				:max="24"
				style="width: 100%"></el-input-number>
		</el-form-item>
		<el-form-item
			v-if="!!optionModel.responsive && formConfig.layoutType === 'PC'"
			:label="i18nt('designer.setting.colSpanTitle') + '(PC)'">
			<el-input-number
				v-model.number="optionModel.md"
				:min="1"
				:max="24"
				style="width: 100%"></el-input-number>
		</el-form-item>
		<el-form-item
			v-if="!!optionModel.responsive && formConfig.layoutType === 'Pad'"
			:label="i18nt('designer.setting.colSpanTitle') + '(Pad)'">
			<el-input-number
				v-model.number="optionModel.sm"
				:min="1"
				:max="24"
				style="width: 100%"></el-input-number>
		</el-form-item>
		<el-form-item
			v-if="!!optionModel.responsive && formConfig.layoutType === 'H5'"
			:label="i18nt('designer.setting.colSpanTitle') + '(H5)'">
			<el-input-number
				v-model.number="optionModel.xs"
				:min="1"
				:max="24"
				style="width: 100%"></el-input-number>
		</el-form-item>
	</div>
</template>

<script>
import i18n from '@/utils/i18n';

export default {
	name: 'GridColSpanEditor',
	mixins: [i18n],
	props: {
		designer: Object,
		selectedWidget: Object,
		optionModel: Object,
	},
	computed: {
		formConfig() {
			return this.designer.formConfig;
		},
	},
};
</script>

<style scoped></style>
