import { ToggleControl } from '@wordpress/components';
import { useContext } from '@wordpress/element';

import { apiContext } from '../..';
import { useSetApi } from '../../hooks/useSetApi';
import { apiType } from '../../types/apiType';
// import { rinkerClasses } from '../../utils/RinkerClassName';
// import { createClassName } from '../../utils/createClassName';

type TogglePropsType = {
	itemKey: 'abc_rinker' | 'abc_logged_in_user';
	label: string;
};

export const Toggle = ( props: TogglePropsType ) => {
	const { itemKey, label } = props;
	const { apiData, setApiData } = useContext( apiContext );

	let checked: boolean = false;
	let setApiValue = false;
	switch ( itemKey ) {
		case 'abc_rinker':
			checked = apiData.abc_rinker!;
			setApiValue = apiData.abc_rinker!;
			break;
		case 'abc_logged_in_user':
			checked = apiData.abc_logged_in_user!;
			setApiValue = apiData.abc_logged_in_user!;
			break;
	}

	const changeStatus = ( status: boolean ) => {
		const newItem: apiType = JSON.parse( JSON.stringify( { ...apiData } ) );

		newItem[ itemKey ] = status;
		setApiData( newItem );
	};

	// if ( apiData.abc_rinker && ! apiData.abc_rinker_classes ) {
	// 	const newRinkerClasses: any = {};
	// 	rinkerClasses.map( ( rinkerClass ) => {
	// 		return ( newRinkerClasses[ rinkerClass ] = createClassName() );
	// 	} );

	// 	const newItem: apiType = JSON.parse( JSON.stringify( { ...apiData } ) );

	// 	newItem.abc_rinker_classes = newRinkerClasses;
	// 	setApiData( newItem );
	// }

	useSetApi( itemKey, setApiValue );
	// useSetApi( 'abc_rinker_classes', apiData.abc_rinker_classes! );

	return (
		<ToggleControl
			label={ label }
			checked={ checked }
			onChange={ ( status ) => {
				changeStatus( status );
			} }
		/>
	);
};
