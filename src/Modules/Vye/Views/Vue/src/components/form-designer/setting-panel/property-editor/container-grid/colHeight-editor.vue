<template>
	<div>
		<el-form-item :label="i18nt('designer.setting.gridColHeight')">
			<el-input
				v-model="optionModel.colHeight"
				type="number"
				min="0"
				class="hide-spin-button"
				@input="inputNumberHandler"></el-input>
		</el-form-item>
	</div>
</template>

<script>
import i18n from '@/utils/i18n';
import propertyMixin from '@/components/form-designer/setting-panel/property-editor/propertyMixin';

export default {
	name: 'ColHeightEditor',
	mixins: [i18n, propertyMixin],
	props: {
		designer: Object,
		selectedWidget: Object,
		optionModel: Object,
	},
};
</script>

<style scoped></style>
