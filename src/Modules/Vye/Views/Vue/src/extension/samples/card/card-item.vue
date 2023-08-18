<template>
	<container-item-wrapper :widget="widget">
		<el-card
			v-show="!widget.options.hidden"
			:key="widget.id"
			:ref="widget.id"
			class="card-container"
			:class="[!!widget.options.folded ? 'folded' : '', customClass]"
			:shadow="widget.options.shadow"
			:style="{ width: widget.options.cardWidth + '!important' || '' }">
			<template #header>
				<div class="clear-fix">
					<span>{{ widget.options.label }}</span>
					<i
						v-if="widget.options.showFold"
						class="float-right"
						@click="toggleCard">
						<template v-if="!widget.options.folded">
							<el-icon><ArrowDown /></el-icon>
						</template>
						<template v-else>
							<el-icon><ArrowUp /></el-icon>
						</template>
					</i>
				</div>
			</template>
			<template v-if="!!widget.widgetList && widget.widgetList.length > 0">
				<template v-for="(subWidget, swIdx) in widget.widgetList">
					<template v-if="'container' === subWidget.category">
						<component
							:is="getComponentByContainer(subWidget)"
							:key="swIdx"
							:widget="subWidget"
							:parent-list="widget.widgetList"
							:index-of-parent-list="swIdx"
							:parent-widget="widget">
							<!-- 递归传递插槽！！！ -->
							<template v-for="slot in Object.keys($slots)" #[slot]="scope">
								<slot :name="slot" v-bind="scope" />
							</template>
						</component>
					</template>
					<template v-else>
						<component
							:is="subWidget.type + '-widget'"
							:key="swIdx"
							:field="subWidget"
							:designer="null"
							:parent-list="widget.widgetList"
							:index-of-parent-list="swIdx"
							:parent-widget="widget">
							<!-- 递归传递插槽！！！ -->
							<template v-for="slot in Object.keys($slots)" #[slot]="scope">
								<slot :name="slot" v-bind="scope" />
							</template>
						</component>
					</template>
				</template>
			</template>
		</el-card>
	</container-item-wrapper>
</template>

<script>
import emitter from '@/utils/emitter';
import i18n from '@/utils/i18n';
import refMixin from '@/components/form-render/refMixin';
import ContainerItemWrapper from '@/components/form-render/container-item/container-item-wrapper';
import containerItemMixin from '@/components/form-render/container-item/containerItemMixin';
import FieldComponents from '@/components/form-designer/form-widget/field-widget/index';
import { ArrowDown, ArrowUp } from '@element-plus/icons-vue';

export default {
	name: 'CardItem',
	componentName: 'ContainerItem',
	components: {
		ContainerItemWrapper,
		...FieldComponents,
		ArrowDown,
		ArrowUp,
	},
	mixins: [emitter, i18n, refMixin, containerItemMixin],
	inject: ['refList', 'sfRefList', 'globalModel'],
	props: {
		widget: Object,
	},
	computed: {
		customClass() {
			return this.widget.options.customClass || '';
		},
	},
	created() {
		this.initRefList();
	},
	beforeUnmount() {
		this.unregisterFromRefList();
	},
	methods: {
		toggleCard() {
			this.widget.options.folded = !this.widget.options.folded;
		},
	},
};
</script>

<style lang="scss" scoped>
:deep(.el-card__header) {
	padding: 10px 12px;
}

.folded :deep(.el-card__body) {
	display: none;
}

.clear-fix:before,
.clear-fix:after {
	display: table;
	content: '';
}

.clear-fix:after {
	clear: both;
}

.float-right {
	float: right;
}
</style>
