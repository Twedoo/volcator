<template>
	<el-form-item :label="i18nt('designer.setting.labelTooltip')">
		<el-input v-model="optionModel.labelTooltip" type="text"></el-input>
	</el-form-item>
</template>

<script>
import i18n from '@/utils/i18n';

export default {
	name: 'LabelTooltipEditor',
	mixins: [i18n],
	props: {
		designer: Object,
		selectedWidget: Object,
		optionModel: Object,
	},
};
</script>

<style scoped></style>
