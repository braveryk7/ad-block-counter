import { ToggleControl } from '@wordpress/components';
import { useContext } from '@wordpress/element';

import { apiContext } from '../..';
import { useSetApi } from '../../hooks/useSetApi';
import { apiType } from '../../types/apiType';

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
