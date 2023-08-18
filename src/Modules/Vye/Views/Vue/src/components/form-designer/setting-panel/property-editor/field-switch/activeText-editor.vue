<template>
	<el-form-item :label="i18nt('designer.setting.activeText')">
		<el-input v-model="optionModel.activeText"></el-input>
	</el-form-item>
</template>

<script>
import i18n from '@/utils/i18n';

export default {
	name: 'ActiveTextEditor',
	mixins: [i18n],
	props: {
		designer: Object,
		selectedWidget: Object,
		optionModel: Object,
	},
};
</script>

<style scoped></style>
