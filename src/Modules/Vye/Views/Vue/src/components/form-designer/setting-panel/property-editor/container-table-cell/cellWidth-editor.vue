<template>
	<el-form-item :label="i18nt('designer.setting.cellWidth')">
		<el-input v-model="optionModel.cellWidth" type="text"></el-input>
	</el-form-item>
</template>

<script>
import i18n from '@/utils/i18n';

export default {
	name: 'CellWidthEditor',
	mixins: [i18n],
	props: {
		designer: Object,
		selectedWidget: Object,
		optionModel: Object,
	},
};
</script>

<style scoped></style>
