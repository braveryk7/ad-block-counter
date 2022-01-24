import { ToggleControl } from '@wordpress/components';
import { useContext } from '@wordpress/element';

import { apiContext } from '../..';
import { useSetApi } from '../../hooks/useSetApi';
import { apiType } from '../../types/apiType';
// import { rinkerClasses } from '../../utils/RinkerClassName';
// import { createClassName } from '../../utils/createClassName';

export const Toggle = ( props: any ) => {
	const { itemKey, label } = props;
	const { apiData, setApiData } = useContext( apiContext );

	const changeStatus = ( status: boolean ) => {
		const newItem: apiType = JSON.parse( JSON.stringify( { ...apiData } ) );

		newItem.abc_rinker = status;
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

	useSetApi( itemKey, apiData.abc_rinker! );
	// useSetApi( 'abc_rinker_classes', apiData.abc_rinker_classes! );

	return (
		<ToggleControl
			label={ label }
			checked={ apiData.abc_rinker }
			onChange={ ( status ) => {
				changeStatus( status );
			} }
		/>
	);
};
