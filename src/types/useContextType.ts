import { Dispatch, SetStateAction } from 'react';

import { apiType } from './apiType';

export type noticeValueType =
	| 'abc_success'
	| 'abc_error'
	| 'success'
	| undefined;

export type apiContextType = {
	apiData: apiType;
	setApiData: Dispatch< SetStateAction< apiType > >;
	setNoticeStatus: Dispatch< SetStateAction< boolean > >;
	setNoticeValue: Dispatch< SetStateAction< noticeValueType > >;
	setNoticeMessage: Dispatch< SetStateAction< string > >;
	snackbarTimer: NodeJS.Timeout;
};
