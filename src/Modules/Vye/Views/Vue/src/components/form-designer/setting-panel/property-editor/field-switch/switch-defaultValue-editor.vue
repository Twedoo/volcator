<template>
	<el-form-item :label="i18nt('designer.setting.defaultValue')">
		<el-switch
			v-model="optionModel.defaultValue"
			active-text="true"
			inactive-text="false"
			@change="emitDefaultValueChange"></el-switch>
	</el-form-item>
</template>

<script>
import i18n from '@/utils/i18n';
import propertyMixin from '@/components/form-designer/setting-panel/property-editor/propertyMixin';

export default {
	name: 'SwitchDefaultValueEditor',
	mixins: [i18n, propertyMixin],
	props: {
		designer: Object,
		selectedWidget: Object,
		optionModel: Object,
	},
};
</script>

<style scoped></style>
