<template>
	<el-form-item :label="i18nt('designer.setting.prefixIcon')">
		<el-input v-model="optionModel.prefixIcon" type="text"></el-input>
	</el-form-item>
</template>

<script>
import i18n from '@/utils/i18n';

export default {
	name: 'PrefixIconEditor',
	mixins: [i18n],
	props: {
		designer: Object,
		selectedWidget: Object,
		optionModel: Object,
	},
};
</script>

<style scoped></style>
