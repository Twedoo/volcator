<template>
	<el-form-item :label="i18nt('designer.setting.validationHint')">
		<el-input v-model="optionModel.validationHint" type="text"></el-input>
	</el-form-item>
</template>

<script>
import i18n from '@/utils/i18n';

export default {
	name: 'ValidationHintEditor',
	mixins: [i18n],
	props: {
		designer: Object,
		selectedWidget: Object,
		optionModel: Object,
	},
};
</script>

<style scoped></style>
