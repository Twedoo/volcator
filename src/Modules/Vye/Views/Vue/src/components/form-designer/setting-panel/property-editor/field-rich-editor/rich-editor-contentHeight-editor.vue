<template>
	<div>
		<el-form-item :label="i18nt('designer.setting.contentHeight')">
			<el-input v-model="optionModel.contentHeight" type="text"></el-input>
		</el-form-item>
	</div>
</template>

<script>
import i18n from '@/utils/i18n';

export default {
	name: 'RichEditorContentHeightEditor',
	mixins: [i18n],
	props: {
		designer: Object,
		selectedWidget: Object,
		optionModel: Object,
	},
};
</script>

<style scoped></style>
