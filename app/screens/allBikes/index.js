import React from "react";
import { Text, Layout} from "@ui-kitten/components";
import {
  Image,
  StyleSheet,
  View,
  ScrollView,
  TouchableWithoutFeedback,
  SafeAreaView
} from "react-native";
import { globalStyles } from "../../shared/globalStyles";
import {
  bikeOne
} from "../../shared/generalAssets";
import { globalConstants } from "../../constants";

const bikeList = [
  {
    name: "Yellow Red Bike",
    date: "15/03/2021",
    image: bikeOne,
    timeSpent: "15 minutes"
  },{
    name: "Yellow Red Bike",
    date: "15/03/2021",
    image: bikeOne,
    timeSpent: "15 minutes"
  },{
    name: "Yellow Red Bike",
    date: "15/03/2021",
    image: bikeOne,
    timeSpent: "15 minutes"
  },{
    name: "Yellow Red Bike",
    date: "15/03/2021",
    image: bikeOne,
    timeSpent: "15 minutes"
  },{
    name: "Yellow Red Bike",
    date: "15/03/2021",
    image: bikeOne,
    timeSpent: "15 minutes"
  },{
    name: "Yellow Red Bike",
    date: "15/03/2021",
    image: bikeOne,
    timeSpent: "15 minutes"
  },{
    name: "Yellow Red Bike",
    date: "15/03/2021",
    image: bikeOne,
    timeSpent: "15 minutes"
  },{
    name: "Yellow Red Bike",
    date: "15/03/2021",
    image: bikeOne,
    timeSpent: "15 minutes"
  },{
    name: "Yellow Red Bike",
    date: "15/03/2021",
    image: bikeOne,
    timeSpent: "15 minutes"
  },{
    name: "Yellow Red Bike",
    date: "15/03/2021",
    image: bikeOne,
    timeSpent: "15 minutes"
  },{
    name: "Yellow Red Bike",
    date: "15/03/2021",
    image: bikeOne,
    timeSpent: "15 minutes"
  },{
    name: "Yellow Red Bike",
    date: "15/03/2021",
    image: bikeOne,
    timeSpent: "15 minutes"
  },{
    name: "Yellow Red Bike",
    date: "15/03/2021",
    image: bikeOne,
    timeSpent: "15 minutes"
  },{
    name: "Yellow Red Bike",
    date: "15/03/2021",
    image: bikeOne,
    timeSpent: "15 minutes"
  },{
    name: "Yellow Red Bike",
    date: "15/03/2021",
    image: bikeOne,
    timeSpent: "15 minutes"
  },{
    name: "Yellow Red Bike",
    date: "15/03/2021",
    image: bikeOne,
    timeSpent: "15 minutes"
  },{
    name: "Yellow Red Bike",
    date: "15/03/2021",
    image: bikeOne,
    timeSpent: "15 minutes"
  },{
    name: "Yellow Red Bike",
    date: "15/03/2021",
    image: bikeOne,
    timeSpent: "15 minutes"
  }
];

 const AllBikes = ({ navigation }) => {
  const ViewBikeDetails = () => {
    navigation.navigate("BikeDetails");
  };
  return (
    <SafeAreaView style={{flex:1}}> 
     <Layout
        style={[
          globalStyles.containerPadding,
          globalStyles.screenBg,
          { height: globalConstants.SCREEN_HEIGHT }
        ]}
      >
      <View style={globalStyles.mt30}>
      <Text
        style={[
          globalStyles.fontAltBold,
          globalStyles.textBold,
          styles.heading
        ]}
      >
        All Bikes
      </Text>
      <ScrollView
        style={{
          height: (90 / 100) * globalConstants.SCREEN_HEIGHT,
          paddingHorizontal: 10
        }}
      >
        {bikeList.map((bike, index) => (
          <TouchableWithoutFeedback onPress={ViewBikeDetails} key={index}>
            <Layout
              style={[
                styles.itemBox,
                globalStyles.shadowBox,
                globalStyles.flexRow
              ]}
              level="1"
            >
              <View  style={[styles.thumbArea, globalStyles.centerCenter, globalStyles.bgWhite]}>
              <Image source={bike.image}  style={styles.thumb}></Image>
              </View>

              <View style={[styles.caption, globalStyles.justifySpaceBetween]}>
                <Text style={[globalStyles.textGray, styles.title]}>
                  {bike.name}
                </Text>
                <Text style={styles.small}> {bike.date}</Text>
                <Text style={styles.small}> {bike.timeSpent} ride</Text>
              </View>
            </Layout>
          </TouchableWithoutFeedback>
        ))}
      </ScrollView>
    </View>
    </Layout>
    </SafeAreaView>
    );
};
export default AllBikes;
const styles = StyleSheet.create({
  itemBox: {
    borderRadius: 5,
    marginVertical: 10,
    minHeight: 80,
    paddingVertical: 10,
    marginHorizontal:0.5
  },
  thumbArea: {
    width:'30%',
    height: "auto",
  },
  thumb: {
    width: '100%',
    height: 50
  },
  caption: {
    paddingHorizontal: 10
  },
  title: {
    textAlign: "justify"
  },
  small: {
    fontSize: 11
  },
  heading: {
    fontSize: 20
  }
});
