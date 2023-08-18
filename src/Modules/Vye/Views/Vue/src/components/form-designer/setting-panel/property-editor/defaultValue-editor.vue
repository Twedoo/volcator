<template>
	<el-form-item
		v-if="!hasConfig('optionItems')"
		:label="i18nt('designer.setting.defaultValue')">
		<el-input
			v-model="optionModel.defaultValue"
			type="text"
			@change="emitDefaultValueChange"></el-input>
	</el-form-item>
</template>

<script>
import i18n from '@/utils/i18n';
import propertyMixin from '@/components/form-designer/setting-panel/property-editor/propertyMixin';

export default {
	name: 'DefaultValueEditor',
	mixins: [i18n, propertyMixin],
	props: {
		designer: Object,
		selectedWidget: Object,
		optionModel: Object,
	},
};
</script>

<style scoped></style>
