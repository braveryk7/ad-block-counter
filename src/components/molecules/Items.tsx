import { ItemsPropsType } from '../../types/ItemType';
import { PREFIX } from '../../utils/constant';

export const Items = ( props: ItemsPropsType ) => {
	const { classValue, title, children } = props;
	return (
		<div className={ `${ PREFIX }-item-wrapper ${ classValue }` }>
			<h2>{ title }</h2>
			{ children }
		</div>
	);
};
