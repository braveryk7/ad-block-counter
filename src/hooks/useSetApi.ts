import { useContext, useEffect, useRef } from 'react';

// @ts-ignore
import api from '@wordpress/api'; // eslint-disable-line
import { __ } from '@wordpress/i18n';

import { apiContext } from '..';
import { useSetApiType } from '../types/useSetApiType';

export const useSetApi: useSetApiType = ( itemKey, value ) => {
	const {
		setNoticeStatus,
		setNoticeValue,
		setNoticeMessage,
		snackbarTimer,
	} = useContext( apiContext );

	const isFirstRender = useRef( true );

	useEffect( () => {
		if ( isFirstRender.current ) {
			isFirstRender.current = false;
		} else {
			api.loadPromise.then( () => {
				const model = new api.models.Settings( {
					[ itemKey ]: value,
				} );
				const save = model.save();

				setNoticeStatus( false );
				clearTimeout( snackbarTimer );

				save.success( () => {
					setNoticeStatus( true );
					setNoticeValue( 'abc_success' );
					setNoticeMessage( __( 'Success.', 'ad-block-counter' ) );
				} );
				save.error( () => {
					setNoticeStatus( true );
					setNoticeValue( 'abc_error' );
					setNoticeMessage( __( 'Error.', 'ad-block-counter' ) );
				} );
			} );
		}
	}, [ itemKey, value ] );
};
