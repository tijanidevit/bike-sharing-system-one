import AsyncStorage from '@react-native-async-storage/async-storage';

export const saveDataToLocalStorage = async(n = {}, ttl = 86400000) => {
    try {
        const now = new Date(),
            item = {
                expiry: now.getTime() + ttl,
                data: n.data
            };
        const jsonValue = JSON.stringify(item)
        await AsyncStorage.setItem(n.title, jsonValue)
    } catch (e) {
        // saving error
        console.log("Error, unable to save");
    }
}

export const modifyLocalStorage = (n = {}) => {
    let existingData = retrieveDataFromLocalStorage(n.title);
    if (!existingData || existingData === undefined) return;

    const newValue = {
        title: n.title
    };
    if (Array.isArray(existingData)) {
        existingData.push(n.data);
        newValue.data = existingData;
    } else {
        newValue.data = {
            ...existingData,
            ...n.data
        };
    }
    return saveDataToLocalStorage(newValue);
};

export const removeDataFromLocalStorage = async(resourceKey) => {
    await AsyncStorage.removeItem(resourceKey)
};

export const retrieveDataFromLocalStorage = async(resourceKey) => {
    try {
        const jsonValue = await AsyncStorage.getItem(resourceKey)
        jsonValue != null ? JSON.parse(jsonValue) : null;
        if (jsonValue !== null) {
            const now = new Date();
            if (jsonValue.expiry) {
                if (now.getTime() > jsonValue.expiry) {
                    removeDataFromLocalStorage(resourceKey);
                    return null;
                }
                return jsonValue.data;
            }
            removeDataFromLocalStorage(resourceKey);
            return null;
        } else {
            return null;
        }
    } catch (e) {
        // error reading value
    }
};