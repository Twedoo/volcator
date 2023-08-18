<template>
	<el-form-item :label="i18nt('designer.setting.container-base')">
		<el-select v-model="optionModel.containerBase">
			<el-option
				v-for="item in containerConfig"
				:key="item.value"
				:selected="Large"
				:label="item.label"
				:value="item.value"></el-option>
		</el-select>
	</el-form-item>
</template>

<script>
import i18n from '@/utils/i18n';

export default {
	name: 'ContainerEditor',
	mixins: [i18n],
	props: {
		designer: Object,
		selectedWidget: Object,
		optionModel: Object,
	},
	data() {
		return {
			containerConfig: [
				{ label: 'Small', value: 'container-design-sm' },
				{ label: 'Medium', value: 'container-design-md' },
				{ label: 'Large', value: 'container-design-lg' },
				{ label: 'Full', value: 'tw-max-w-full' },
			],
		};
	},
};
</script>

<style scoped></style>
