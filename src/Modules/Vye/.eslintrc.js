module.exports = {
	root: true,
	env: { node: true },
	parser: 'vue-eslint-parser',
	parserOptions: {
		parser: '@typescript-eslint/parser',
	},
	plugins: ['prettier'],
	extends: ['plugin:vue/vue3-recommended', 'prettier'],
	rules: {
		'no-console': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
		'no-debugger': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
		'prettier/prettier': 'error',
	},
};
