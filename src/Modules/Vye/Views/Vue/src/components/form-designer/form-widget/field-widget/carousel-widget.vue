<template>
	<static-content-wrapper
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
		<!--        <div class="block text-center">-->
		<!--            <span class="demonstration">Switch when indicator is hovered (default)</span>-->
		<!--            <el-carousel height="150px">-->
		<!--                <el-carousel-item v-for="item in 4" :key="item">-->
		<!--                    <h3 class="small justify-center" text="2xl">{{ item }}</h3>-->
		<!--                </el-carousel-item>-->
		<!--            </el-carousel>-->
		<!--        </div>-->
		<div ref="fieldEditor" class="block text-center" m="t-4">
			<span class="demonstration">Switch when indicator is clicked</span>
			<el-carousel trigger="click" height="150px">
				<el-carousel-item v-for="item in 4" :key="item">
					<h3 class="small justify-center" text="2xl">{{ item }}</h3>
				</el-carousel-item>
			</el-carousel>
		</div>
	</static-content-wrapper>
</template>

<script>
import StaticContentWrapper from './static-content-wrapper';
import emitter from '@/utils/emitter';
import i18n, { translate } from '@/utils/i18n';
import fieldMixin from '@/components/form-designer/form-widget/field-widget/fieldMixin';

export default {
	name: 'CarouselWidget',
	componentName: 'FieldWidget',
	components: {
		StaticContentWrapper,
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
.full-width-input {
	width: 100% !important;
}
.demonstration {
	color: var(--el-text-color-secondary);
}

.el-carousel__item h3 {
	color: #475669;
	opacity: 0.75;
	line-height: 150px;
	margin: 0;
	text-align: center;
}

.el-carousel__item:nth-child(2n) {
	background-color: #99a9bf;
}

.el-carousel__item:nth-child(2n + 1) {
	background-color: #d3dce6;
}
</style>
<style lang="scss" scoped>
@import '../../../../styles/global.scss'; //* static-content-wrapper已引入，还需要重复引入吗？ *//
</style>
