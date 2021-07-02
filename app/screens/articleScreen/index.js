import React from "react";
import { Card, Divider, Layout, Text, Icon } from "@ui-kitten/components";
import {
  SafeAreaView,
  View,
  StyleSheet,
  ScrollView,
  useWindowDimensions
} from "react-native";
import { useDispatch, useSelector } from "react-redux";
import { globalConstants } from "../../constants";
import { globalStyles } from "../../shared/globalStyles";
import { CommentModal } from "../../components/Article";
import HTML from "react-native-render-html";

const htmlContent = `
    <div style="color:#333;text-align:justify">
    <p  style="text-align:justify">After the meeting held by the management of the Federal Polytechnic, Igbehin, yesterday 18th, April 1984. It has been concluded that all academic staff and students should come back to school. However, this news is intended to conduct a test on an application, so all of you that you can now go back to what you were doing...</p>
    <p>Enjoy a stress-free and blazing fast application</p>
    <img src="https://i.imgur.com/dHLmxfO.jpg?2" />
    </div>
`;

const Header = (props) => (
  <View {...props}>
    <Text category="h6" style={[globalStyles.mb20, globalStyles.textSecondary]}>
      FPI to call-off ASUP strike by Monday, 23rd of this month.
    </Text>
    <Divider />
    <Text category="s1" style={globalStyles.textSmall}>
      By{" "}
      <Text style={[globalStyles.textPrimary, globalStyles.textSmall]}>
        Ismail Obadimu
      </Text>
    </Text>
  </View>
);

const Article = ({ navigation, route }) => {
  const contentWidth = useWindowDimensions().width;
  return (
    <SafeAreaView style={{ flex: 1 }}>
      <View
        style={[
          globalStyles.flexRow,
          globalStyles.justifySpaceBetween,
          styles.misc
        ]}
      >
        <Text style={globalStyles.textSmall}>5 minutes ago</Text>
        <View
          style={[
            globalStyles.flexRow,
            globalStyles.centerCenter,
            { width: "20%" }
          ]}
        >
          <Icon style={styles.icon} fill="#8F9BB3" name="eye-outline" />
          <Text style={[globalStyles.textGray, globalStyles.textSmall]}>
            1,139
          </Text>
        </View>

        <CommentModal />
      </View>

      <ScrollView>
        <Layout style={[globalStyles.containerPadding, globalStyles.screenBg]}>
          <Card style={[styles.card]} status="warning" header={Header}>
            <HTML source={{ html: htmlContent }} contentWidth={contentWidth} />
          </Card>
        </Layout>
      </ScrollView>
    </SafeAreaView>
  );
};
export default Article;

const styles = StyleSheet.create({
  card: {
    marginVertical: 10
  },
  misc: {
    width: globalConstants.SCREEN_WIDTH,
    padding: 20
  },
  icon: {
    height: 15,
    width: 15
  }
});
