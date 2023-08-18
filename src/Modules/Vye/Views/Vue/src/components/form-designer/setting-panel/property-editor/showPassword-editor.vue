<template>
	<el-form-item
		v-if="optionModel.type === 'password'"
		:label="i18nt('designer.setting.showPassword')">
		<el-switch v-model="optionModel.showPassword"></el-switch>
	</el-form-item>
</template>

<script>
import i18n from '@/utils/i18n';

export default {
	name: 'ShowPasswordEditor',
	mixins: [i18n],
	props: {
		designer: Object,
		selectedWidget: Object,
		optionModel: Object,
	},
};
</script>

<style scoped></style>
