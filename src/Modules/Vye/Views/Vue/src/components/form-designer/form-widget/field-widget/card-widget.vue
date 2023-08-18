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
		<el-row>
			<el-col
				v-for="(o, index) in 3"
				:key="o"
				:span="6"
				:offset="index > 0 ? 3 : 0">
				<el-card :body-style="{ padding: '0px' }">
					<img
						src="https://shadow.elemecdn.com/app/element/hamburger.9cf7b091-55e9-11e9-a976-7f4d0b07eef6.png"
						class="image" />
					<div style="padding: 14px">
						<span>Yummy hamburger</span>
						<div class="bottom">
							<time class="time">4 pieces Veal</time>
							<el-button text class="button">
								<strong>Price 140 $</strong>
							</el-button>
						</div>
					</div>
				</el-card>
			</el-col>
		</el-row>
		<div class="tw-flex tw-font-sans">
			<div class="tw-flex-none tw-w-48 tw-relative">
				<img
					src="https://tailwindcss.com/_next/static/media/classic-utility-jacket.82031370.jpg"
					alt=""
					class="tw-absolute tw-inset-0 tw-w-full tw-h-full tw-object-cover"
					loading="lazy" />
			</div>
			<form class="tw-flex-auto tw-p-6">
				<div class="tw-flex tw-flex-wrap">
					<h1
						class="tw-flex-auto tw-text-lg tw-font-semibold tw-text-slate-900">
						<i class="tw-fa-regular tw-fa-stop"></i>
						Classic Utility Jacket
						<i class="tw-fa-solid tw-fa-mobile-button"></i>
					</h1>
					<div class="tw-text-lg tw-font-semibold tw-text-slate-500">
						$110.00
					</div>
					<div
						class="tw-w-full tw-flex-none tw-text-sm tw-font-medium tw-text-slate-700 tw-mt-2">
						In stock
					</div>
				</div>
				<div
					class="tw-flex tw-items-baseline tw-mt-4 tw-mb-6 tw-pb-6 tw-border-b tw-border-slate-200">
					<div class="tw-space-x-2 tw-flex tw-text-sm">
						<label>
							<input
								class="sr-only peer"
								name="size"
								type="radio"
								value="xs"
								checked />
							<div
								class="tw-w-9 tw-h-9 tw-rounded-lg tw-flex tw-items-center tw-justify-center tw-text-slate-700 tw-peer-checked:tw-font-semibold tw-peer-checked:bg-slate-900 tw-peer-checked:tw-text-white">
								XS
							</div>
						</label>
						<label>
							<input class="sr-only peer" name="size" type="radio" value="s" />
							<div
								class="tw-w-9 tw-h-9 tw-rounded-lg tw-flex tw-items-center tw-justify-center tw-text-slate-700 tw-peer-checked:tw-font-semibold tw-peer-checked:tw-bg-slate-900 tw-peer-checked:tw-text-white">
								S
							</div>
						</label>
						<label>
							<input class="sr-only peer" name="size" type="radio" value="m" />
							<div
								class="tw-w-9 tw-h-9 tw-rounded-lg tw-flex tw-items-center tw-justify-center tw-text-slate-700 tw-peer-checked:tw-font-semibold tw-peer-checked:tw-bg-slate-900 tw-peer-checked:tw-text-white">
								M
							</div>
						</label>
						<label>
							<input class="sr-only peer" name="size" type="radio" value="l" />
							<div
								class="tw-w-9 tw-h-9 tw-rounded-lg tw-flex tw-items-center tw-justify-center tw-text-slate-700 tw-peer-checked:tw-font-semibold tw-peer-checked:tw-bg-slate-900 tw-peer-checked:tw-text-white">
								L
							</div>
						</label>
						<label>
							<input class="sr-only peer" name="size" type="radio" value="xl" />
							<div
								class="tw-w-9 tw-h-9 tw-rounded-lg tw-flex tw-items-center tw-justify-center tw-text-slate-700 tw-peer-checked:tw-font-semibold tw-peer-checked:tw-bg-slate-900 tw-peer-checked:tw-text-white">
								XL
							</div>
						</label>
					</div>
				</div>
				<div class="tw-flex tw-space-x-4 tw-mb-6 tw-text-sm tw-font-medium">
					<div class="tw-flex-auto flex tw-space-x-4">
						<button
							class="tw-h-10 tw-px-6 tw-font-semibold tw-rounded-md tw-bg-black tw-text-white"
							type="submit">
							Buy now
						</button>
						<button
							class="tw-h-10 tw-px-6 tw-font-semibold tw-rounded-md tw-border border-slate-200 tw-text-slate-900"
							type="button">
							Add to bag
						</button>
					</div>
					<button
						class="tw-flex-none tw-flex tw-items-center tw-justify-center tw-w-9 tw-h-9 tw-rounded-md tw-text-slate-300 tw-border tw-border-slate-200"
						type="button"
						aria-label="Like">
						<svg width="20" height="20" fill="currentColor" aria-hidden="true">
							<path
								fill-rule="evenodd"
								clip-rule="evenodd"
								d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
						</svg>
					</button>
				</div>
				<p class="tw-text-sm tw-text-slate-700">
					Free shipping on all continental US orders.
				</p>
			</form>
		</div>
	</form-item-wrapper>
</template>

<script>
import FormItemWrapper from './form-item-wrapper';

import emitter from '@/utils/emitter';
import i18n, { translate } from '@/utils/i18n';
import fieldMixin from '@/components/form-designer/form-widget/field-widget/fieldMixin';
import { ref } from 'vue';

const currentDate = ref(new Date());

export default {
	name: 'CardWidget',
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
.time {
	font-size: 12px;
	color: #999;
}

.bottom {
	margin-top: 13px;
	line-height: 12px;
	display: flex;
	justify-content: space-between;
	align-items: center;
}

.button {
	padding: 0;
	min-height: auto;
}

.image {
	width: 100%;
	display: block;
}
</style>
<style lang="scss" scoped>
@import '../../../../styles/global.scss'; //* static-content-wrapper已引入，还需要重复引入吗？ *//
</style>
