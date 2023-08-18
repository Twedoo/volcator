<template>
	<el-form-item v-if="!noLabelSetting" :label="i18nt('designer.setting.label')">
		<el-input v-model="optionModel.label" type="text"></el-input>
	</el-form-item>
</template>

<script>
import i18n from '@/utils/i18n';

export default {
	name: 'LabelEditor',
	mixins: [i18n],
	props: {
		designer: Object,
		selectedWidget: Object,
		optionModel: Object,
	},
	computed: {
		noLabelSetting() {
			return (
				this.selectedWidget.type === 'static-text' ||
				this.selectedWidget.type === 'html-text'
			);
			//|| (this.selectedWidget.type === 'divider')
		},
	},
};
</script>

<style lang="scss" scoped></style>
