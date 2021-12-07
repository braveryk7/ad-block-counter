import { ToggleControl } from '@wordpress/components';
import { useContext } from '@wordpress/element';

import { apiContext } from '../..';
import { useSetApi } from '../../hooks/useSetApi';
import { apiType } from '../../types/apiType';

export const Toggle = ( props: any ) => {
	const { itemKey, label } = props;
	const { apiData, setApiData } = useContext( apiContext );

	const changeStatus = ( status: boolean ) => {
		const newItem: apiType = JSON.parse( JSON.stringify( { ...apiData } ) );

		newItem.abc_rinker = status;
		setApiData( newItem );
	};

	useSetApi( itemKey, apiData.abc_rinker! );

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
