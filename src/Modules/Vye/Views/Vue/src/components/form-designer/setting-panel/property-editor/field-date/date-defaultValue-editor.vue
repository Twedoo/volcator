<template>
	<el-form-item :label="i18nt('designer.setting.defaultValue')">
		<el-date-picker
			v-model="optionModel.defaultValue"
			:type="optionModel.type"
			:format="optionModel.format"
			:value-format="optionModel.valueFormat"
			style="width: 100%"
			@change="emitDefaultValueChange"></el-date-picker>
	</el-form-item>
</template>

<script>
import i18n from '@/utils/i18n';
import propertyMixin from '@/components/form-designer/setting-panel/property-editor/propertyMixin';

export default {
	name: 'DateDefaultValueEditor',
	mixins: [i18n, propertyMixin],
	props: {
		designer: Object,
		selectedWidget: Object,
		optionModel: Object,
	},
};
</script>

<style scoped></style>
