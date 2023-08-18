<template>
	<form-item-wrapper
		:designer="designer"
		:field="field"
		:rules="rules"
		:design-state="designState"
		:parent-widget="parentWidget"
		:parent-list="parentList"
		:index-of-parent-list="indexOfParentList"
		:sub-form-row-index="subFormRowIndex"
		:sub-form-col-index="subFormColIndex"
		:sub-form-row-id="subFormRowId">
		<el-menu
			:default-active="activeIndex"
			class="full-width-input"
			mode="horizontal"
			:ellipsis="false"
			@select="handleSelect">
			<el-menu-item index="0">LOGO</el-menu-item>
			<div class="flex-grow" />
			<el-menu-item index="1">Processing Center</el-menu-item>
			<el-sub-menu index="2">
				<template #title>Workspace</template>
				<el-menu-item index="2-1">item one</el-menu-item>
				<el-menu-item index="2-2">item two</el-menu-item>
				<el-menu-item index="2-3">item three</el-menu-item>
				<el-sub-menu index="2-4">
					<template #title>item four</template>
					<el-menu-item index="2-4-1">item one</el-menu-item>
					<el-menu-item index="2-4-2">item two</el-menu-item>
					<el-menu-item index="2-4-3">item three</el-menu-item>
				</el-sub-menu>
			</el-sub-menu>
		</el-menu>
	</form-item-wrapper>
</template>

<script>
import FormItemWrapper from './form-item-wrapper';
import emitter from '@/utils/emitter';
import i18n, { translate } from '@/utils/i18n';
import fieldMixin from '@/components/form-designer/form-widget/field-widget/fieldMixin';

export default {
	name: 'MenuHorizontalWidget',
	componentName: 'FieldWidget',
	components: {
		FormItemWrapper,
	}, //必须固定为FieldWidget，用于接收父级组件的broadcast事件
	mixins: [emitter, fieldMixin, i18n],
	props: {
		field: Object,
		parentWidget: Object,
		parentList: Array,
		indexOfParentList: Number,
		designer: Object,

		designState: {
			type: Boolean,
			default: false,
		},

		subFormRowIndex: {
			/* 子表单组件行索引，从0开始计数 */ type: Number,
			default: -1,
		},
		subFormColIndex: {
			/* 子表单组件列索引，从0开始计数 */ type: Number,
			default: -1,
		},
		subFormRowId: {
			/* 子表单组件行Id，唯一id且不可变 */ type: String,
			default: '',
		},
	},
	computed: {},
	beforeCreate() {
		/* 这里不能访问方法和属性！！ */
	},

	created() {
		/* 注意：子组件mounted在父组件created之后、父组件mounted之前触发，故子组件mounted需要用到的prop
               需要在父组件created中初始化！！ */
		this.registerToRefList();
		this.initEventHandler();

		this.handleOnCreated();
	},

	mounted() {
		this.handleOnMounted();
	},

	beforeUnmount() {
		this.unregisterFromRefList();
	},

	methods: {},
};
</script>

<style>
.flex-grow {
	flex-grow: 1;
}

.full-width-input {
	width: 100% !important;
}
</style>
