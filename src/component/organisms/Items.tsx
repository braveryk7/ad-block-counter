import { ItemsPropsType } from '../../types/ItemType';

export const Items = ( props: ItemsPropsType ) => {
	const { classValue, title, children } = props;
	return (
		<div className={ 'abc-item-wrapper ' + classValue }>
			<h2>{ title }</h2>
			{ children }
		</div>
	);
};
