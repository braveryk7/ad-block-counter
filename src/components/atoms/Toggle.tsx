import { ToggleControl } from '@wordpress/components';
import { useContext } from '@wordpress/element';

import { apiContext } from '../..';
import { useSetApi } from '../../hooks/useSetApi';
import { TogglePropsType } from '../../types/ComponentsType';
import { apiType } from '../../types/apiType';
import { addPrefix } from '../../utils/constant';

export const Toggle = ( props: TogglePropsType ) => {
	const { itemKey, label } = props;
	const { apiData, setApiData } = useContext( apiContext );

	let checked = false;
	let setApiValue = false;
	switch ( itemKey ) {
		case addPrefix( 'use_rinker' ):
			if ( apiData.abc_use_rinker ) {
				checked = apiData.abc_use_rinker;
				setApiValue = apiData.abc_use_rinker;
			}
			break;
		case addPrefix( 'logged_in_user' ):
			if ( apiData.abc_logged_in_user ) {
				checked = apiData.abc_logged_in_user;
				setApiValue = apiData.abc_logged_in_user;
			}
			break;
	}

	const changeStatus = ( status: boolean ) => {
		const newItem: apiType = JSON.parse( JSON.stringify( { ...apiData } ) );

		newItem[ itemKey ] = status;
		setApiData( newItem );
	};

	useSetApi( itemKey, setApiValue );

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
