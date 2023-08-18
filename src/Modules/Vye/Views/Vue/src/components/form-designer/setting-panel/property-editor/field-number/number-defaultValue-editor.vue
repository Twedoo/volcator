<template>
	<el-form-item :label="i18nt('designer.setting.defaultValue')">
		<el-input-number
			v-if="!hasConfig('optionItems')"
			v-model="optionModel.defaultValue"
			type="text"
			style="width: 100%"
			@change="emitDefaultValueChange"></el-input-number>
	</el-form-item>
</template>

<script>
import i18n from '@/utils/i18n';
import propertyMixin from '@/components/form-designer/setting-panel/property-editor/propertyMixin';

export default {
	name: 'NumberDefaultValueEditor',
	mixins: [i18n, propertyMixin],
	props: {
		designer: Object,
		selectedWidget: Object,
		optionModel: Object,
	},
};
</script>

<style scoped></style>
