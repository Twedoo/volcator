<template>
	<el-form-item :label="i18nt('designer.setting.minLength')">
		<el-input
			v-model="minLength"
			type="number"
			class="hide-spin-button"
			min="0"
			style="width: 100%"
			@input="inputNumberHandler"></el-input>
	</el-form-item>
</template>

<script>
import i18n from '@/utils/i18n';
import propertyMixin from '@/components/form-designer/setting-panel/property-editor/propertyMixin';

export default {
	name: 'MinLengthEditor',
	mixins: [i18n, propertyMixin],
	props: {
		designer: Object,
		selectedWidget: Object,
		optionModel: Object,
	},
	computed: {
		minLength: {
			get() {
				return this.optionModel['minLength'];
			},

			set(newValue) {
				if (!newValue || isNaN(newValue)) {
					this.optionModel.minLength = null;
				} else {
					this.optionModel.minLength = Number(newValue);
				}
			},
		},
	},
};
</script>

<style scoped></style>
