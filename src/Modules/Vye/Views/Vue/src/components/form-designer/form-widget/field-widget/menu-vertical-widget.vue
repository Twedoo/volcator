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
		<el-row class="tac">
			<!--            <el-col :span="12">-->
			<!--                <h5 class="mb-2">Default colors</h5>-->
			<!--                <el-menu-->
			<!--                    default-active="2"-->
			<!--                    class="el-menu-vertical-demo"-->
			<!--                    @open="handleOpen"-->
			<!--                    @close="handleClose"-->
			<!--                >-->
			<!--                    <el-sub-menu index="1">-->
			<!--                        <template #title>-->
			<!--                            <el-icon><location /></el-icon>-->
			<!--                            <span>Navigator One</span>-->
			<!--                        </template>-->
			<!--                        <el-menu-item-group title="Group One">-->
			<!--                            <el-menu-item index="1-1">item one</el-menu-item>-->
			<!--                            <el-menu-item index="1-2">item two</el-menu-item>-->
			<!--                        </el-menu-item-group>-->
			<!--                        <el-menu-item-group title="Group Two">-->
			<!--                            <el-menu-item index="1-3">item three</el-menu-item>-->
			<!--                        </el-menu-item-group>-->
			<!--                        <el-sub-menu index="1-4">-->
			<!--                            <template #title>item four</template>-->
			<!--                            <el-menu-item index="1-4-1">item one</el-menu-item>-->
			<!--                        </el-sub-menu>-->
			<!--                    </el-sub-menu>-->
			<!--                    <el-menu-item index="2">-->
			<!--                        <el-icon><icon-menu /></el-icon>-->
			<!--                        <span>Navigator Two</span>-->
			<!--                    </el-menu-item>-->
			<!--                    <el-menu-item index="3" disabled>-->
			<!--                        <el-icon><document /></el-icon>-->
			<!--                        <span>Navigator Three</span>-->
			<!--                    </el-menu-item>-->
			<!--                    <el-menu-item index="4">-->
			<!--                        <el-icon><setting /></el-icon>-->
			<!--                        <span>Navigator Four</span>-->
			<!--                    </el-menu-item>-->
			<!--                </el-menu>-->
			<!--            </el-col>-->
			<!--            <el-col :span="12">-->
			<!--                <h5 class="mb-2">Custom colors</h5>-->
			<el-menu
				active-text-color="#ffd04b"
				background-color="#545c64"
				class="el-menu-vertical-demo"
				default-active="2"
				text-color="#fff"
				@open="handleOpen"
				@close="handleClose">
				<el-sub-menu index="1">
					<template #title>
						<el-icon><location /></el-icon>
						<span>Navigator One</span>
					</template>
					<el-menu-item-group title="Group One">
						<el-menu-item index="1-1">item one</el-menu-item>
						<el-menu-item index="1-2">item two</el-menu-item>
					</el-menu-item-group>
					<el-menu-item-group title="Group Two">
						<el-menu-item index="1-3">item three</el-menu-item>
					</el-menu-item-group>
					<el-sub-menu index="1-4">
						<template #title>item four</template>
						<el-menu-item index="1-4-1">item one</el-menu-item>
					</el-sub-menu>
				</el-sub-menu>
				<el-menu-item index="2">
					<el-icon><icon-menu /></el-icon>
					<span>Navigator Two</span>
				</el-menu-item>
				<el-menu-item index="3" disabled>
					<el-icon><document /></el-icon>
					<span>Navigator Three</span>
				</el-menu-item>
				<el-menu-item index="4">
					<el-icon><setting /></el-icon>
					<span>Navigator Four</span>
				</el-menu-item>
			</el-menu>
			<!--            </el-col>-->
		</el-row>
	</form-item-wrapper>
</template>

<script>
// import {
//     Document,
//     Menu as IconMenu,
//     Location,
//     Setting,
// } from '@element-plus/icons-vue'
// const handleOpen = (key: string, keyPath: string[]) => {
//     console.log(key, keyPath)
// }
// const handleClose = (key: string, keyPath: string[]) => {
//     console.log(key, keyPath)
// }
// import i18n from "@/utils/i18n"
//
// export default {
//     name: "menu-vertical-editor",
//     mixins: [i18n],
//     props: {
//         designer: Object,
//         selectedWidget: Object,
//         optionModel: Object,
//     },
// }

import FormItemWrapper from './form-item-wrapper';
import emitter from '@/utils/emitter';
import i18n, { translate } from '@/utils/i18n';
import fieldMixin from '@/components/form-designer/form-widget/field-widget/fieldMixin';

export default {
	name: 'MenuVerticalWidget',
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
<style lang="scss" scoped>
@import '../../../../styles/global.scss'; //* static-content-wrapper已引入，还需要重复引入吗？ *//
</style>
