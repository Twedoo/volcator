<template>
	<container-item-wrapper :widget="widget">
		<div
			v-show="!widget.options.hidden"
			:key="widget.id"
			class="table-container">
			<table :ref="widget.id" class="table-layout" :class="[customClass]">
				<tbody>
					<tr v-for="(row, rowIdx) in widget.rows" :key="row.id">
						<template v-for="(colWidget, colIdx) in row.cols">
							<table-cell-item
								v-if="!colWidget.merged"
								:key="colIdx"
								:widget="colWidget"
								:parent-list="widget.cols"
								:row-index="rowIdx"
								:col-index="colIdx"
								:parent-widget="widget">
								<!-- 递归传递插槽！！！ -->
								<template v-for="slot in Object.keys($slots)" #[slot]="scope">
									<slot :name="slot" v-bind="scope" />
								</template>
							</table-cell-item>
						</template>
					</tr>
				</tbody>
			</table>
		</div>
	</container-item-wrapper>
</template>

<script>
import emitter from '@/utils/emitter';
import i18n from '../../../utils/i18n';
import refMixin from '../../../components/form-render/refMixin';
import ContainerItemWrapper from './container-item-wrapper';
import TableCellItem from './table-cell-item';
import containerItemMixin from './containerItemMixin';

export default {
	name: 'TableItem',
	componentName: 'ContainerItem',
	components: {
		ContainerItemWrapper,
		TableCellItem,
	},
	mixins: [emitter, i18n, refMixin, containerItemMixin],
	inject: ['refList', 'sfRefList', 'globalModel'],
	props: {
		widget: Object,
	},
	created() {
		this.initRefList();
	},
	mounted() {},
	beforeUnmount() {
		this.unregisterFromRefList();
	},
	methods: {},
};
</script>

<style lang="scss" scoped>
div.table-container {
	table.table-layout {
		width: 100%;
		table-layout: fixed;
		border-collapse: collapse;
	}
}
</style>
