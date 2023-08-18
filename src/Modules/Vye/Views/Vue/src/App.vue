<template>
	<el-config-provider :locale="elLocale">
		<div id="app">
            <RouterView />
		</div>
	</el-config-provider>
</template>

<script>

import zhCNLang from 'element-plus/lib/locale/lang/zh-cn';
import enUSLang from 'element-plus/lib/locale/lang/en';

export default {
	name: 'App',
	data() {
		return {
			formJson: {
				widgetList: [],
				formConfig: {
					modelName: 'volcatorData',
					refName: 'volcatorForm',
                    pageName: "index",
                    homePage: false,
                    newApplication: true,
                    id: '',
                    rulesName: 'rules',
					labelWidth: 80,
					labelPosition: 'left',
					size: '',
					container: 'tw-sm',
					droppableButton: true,
                    previewOrRender: false,
					labelAlign: 'label-left-align',
					cssCode: '',
					customClass: '',
					functions: '',
					layoutType: 'PC',
					onFormCreated: '',
					onFormMounted: '',
					onFormDataChange: '',
					onFormValidate: '',
				},
			},
			formData: {},
			optionData: {},

			elLocaleMap: {
				'zh-CN': zhCNLang,
				'en-US': enUSLang,
			},
		};
	},
	computed: {
		elLocale() {
			let curLocale = localStorage.getItem('v_form_locale') || 'zh-CN';
			return this.elLocaleMap[curLocale];
		},
	},
	methods: {
		submitForm() {
			this.$refs.vFormRef
				.getFormData()
				.then((formData) => {
					// Form Validation OK
					alert(JSON.stringify(formData));
				})
				.catch((error) => {
					// Form Validation failed
					this.$message.error(error);
				});
		},
	},
};
</script>

<style lang="scss">
#app {
	height: 100%;
}
</style>
