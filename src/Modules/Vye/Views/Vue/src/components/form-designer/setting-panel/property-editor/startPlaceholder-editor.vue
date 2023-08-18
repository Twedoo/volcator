<template>
	<el-form-item :label="i18nt('designer.setting.startPlaceholder')">
		<el-input v-model="optionModel.startPlaceholder" type="text"></el-input>
	</el-form-item>
</template>

<script>
import i18n from '@/utils/i18n';

export default {
	name: 'StartPlaceholderEditor',
	mixins: [i18n],
	props: {
		designer: Object,
		selectedWidget: Object,
		optionModel: Object,
	},
};
</script>

<style scoped></style>
