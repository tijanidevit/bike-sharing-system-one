export const catchApiRequestError = (error) => {
    // if ( error.message ) {
    //   return error.message;
    // }
    console.log(error);
    return "Opps! The server has encountered a temporary error.";
};
export const handleApiResponseError = (response) => {
    return response.message;
};