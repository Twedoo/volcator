<template>
	<el-form-item :label="i18nt('designer.setting.maxLength')">
		<el-input
			v-model="maxLength"
			type="number"
			class="hide-spin-button"
			min="1"
			style="width: 100%"
			@input="inputNumberHandler"></el-input>
	</el-form-item>
</template>

<script>
import i18n from '@/utils/i18n';
import propertyMixin from '@/components/form-designer/setting-panel/property-editor/propertyMixin';

export default {
	name: 'MaxLengthEditor',
	mixins: [i18n, propertyMixin],
	props: {
		designer: Object,
		selectedWidget: Object,
		optionModel: Object,
	},
	computed: {
		maxLength: {
			get() {
				return this.optionModel['maxLength'];
			},

			set(newValue) {
				if (!newValue || isNaN(newValue)) {
					this.optionModel.maxLength = null;
				} else {
					this.optionModel.maxLength = Number(newValue);
				}
			},
		},
	},
};
</script>

<style scoped></style>
